<?php

namespace App\Services\Documentation;

use App\Contracts\LocaleInterface;
use App\CustomParser;
use App\Documentation;
use Illuminate\Filesystem\Filesystem;
use ParsedownExtra;
use Vinkla\Algolia\AlgoliaManager;

class Indexer
{
    /**
     * The name of the index.
     *
     * @var string
     */
    protected static $index_name = 'docs';

    /**
     * The Algolia Index instance.
     *
     * @var \AlgoliaSearch\Index
     */
    protected $index;

    /**
     * The Algolia client instance.
     *
     * @var \AlgoliaSearch\Client
     */
    protected $client;

    /**
     * The Parsedown parser instance.
     *
     * @var ParsedownExtra
     */
    protected $markdown;

    /**
     * The filesystem instance.
     *
     * @var Filesystem
     */
    protected $files;

    /**
     * Documentation files that should not be indexed.
     *
     * @var array
     */
    protected $noIndex = [
        'contributing',
        'documentation',
        'license',
        'releases',
    ];

    /**
     * The list of HTML elements and their importance.
     *
     * @var array
     */
    protected $tags = [
        'h1' => 0,
        'h2' => 1,
        'h3' => 2,
        'h4' => 3,
        'h5' => 4,
        'p'  => 5,
        'td' => 5,
        'li' => 5
    ];

    /**
     * @var LocaleInterface
     */
    protected $locale;

    /**
     * Create a new indexer service.
     *
     * @param  AlgoliaManager $client
     * @param  CustomParser $markdown
     * @param  Filesystem $files
     * @param LocaleInterface $locale
     */
    public function __construct(AlgoliaManager $client, CustomParser $markdown, Filesystem $files, LocaleInterface $locale)
    {
        $this->files = $files;
        $this->client = $client;
        $this->markdown = $markdown;
        $this->index = $client->initIndex(static::$index_name.'_tmp');
        $this->locale = $locale;
    }

    /**
     * Index all of the available documentation.
     *
     * @return void
     */
    public function indexAllDocuments()
    {
        foreach ($this->locale->getAvailableLocales() as $locale) {
            $this->indexAllDocumentsForVersion($locale);
        }

        $this->setSettings();

        $this->client->moveIndex($this->index->indexName, static::$index_name);
    }

    /**
     * Index all documentation for a given version.
     *
     * @param string $locale
     */
    public function indexAllDocumentsForVersion($locale)
    {
        $localPath = base_path('resources/docs/'.$locale.'/');
        
        foreach ($this->files->files($localPath) as $path) {
            if (! in_array(basename($path, '.md'), $this->noIndex)) {
                $this->indexDocument($locale, $path);
            }
        }
    }

    /**
     * Index a given document in Algolia
     *
     * @param string $locale
     * @param string $path
     */
    public function indexDocument($locale, $path)
    {
        $markdown = Documentation::replaceLinks($locale, $this->files->get($path));

        $slug = basename($path, '.md');

        $blocs = $this->markdown->getBlocks($markdown);

        $markup = [];

        $current_link = $slug;

        $current = [
            'h1' => null,
            'h2' => null,
            'h3' => null,
            'h4' => null,
            'h5' => null,
        ];

        $excludedBlocTypes = ['Code', 'Quote', 'Markup', 'FencedCode'];

        foreach ($blocs as $bloc) {
            // If the block type should be excluded, skip it...
            if (isset($bloc['hidden']) || (isset($bloc['type']) && in_array($bloc['type'], $excludedBlocTypes)) || $bloc['element']['name'] == 'ul') {
                continue;
            }

            if (isset($bloc['type']) && $bloc['type'] == 'Table') {
                foreach ($bloc['element']['text'][1]['text'] as $tr) {
                    $markup[] = $this->getObject($tr['text'][1], $locale, $current, $current_link);
                }

                continue;
            }

            if (isset($bloc['type']) && $bloc['type'] == 'List') {
                foreach ($bloc['element']['text'] as $li) {
                    $li['text'] = $li['text'][0];

                    $markup[] = $this->getObject($li, $locale, $current, $current_link);
                }

                continue;
            }

            if (isset($bloc['element']['text'])) {
                preg_match('/<a name=\"([^\"]*)\">.*<\/a>/iU', $bloc['element']['text'], $link);

                if (count($link) > 0) {
                    $current_link = $slug.'#'.$link[1];
                } else {
                    $markup[] = $this->getObject($bloc['element'], $locale, $current, $current_link);
                }
            }
        }

        $this->index->addObjects($markup);

        echo "Indexed {$locale} {$slug}" . PHP_EOL;
    }

    /**
     * @param $element_name
     * @return mixed
     */
    public function getPositionFromElementName($element_name)
    {
        $elements = ['h1', 'h2', 'h3', 'h4', 'h5'];

        return array_search($element_name, $elements);
    }

    /**
     * Get the object to be indexed in Algolia.
     *
     * @param array $element
     * @param string $locale
     * @param string $current_link
     *
     * @return array
     */
    protected function getObject($element, $locale, &$current, &$current_link)
    {
        $text = [
            'h1' => null,
            'h2' => null,
            'h3' => null,
            'h4' => null,
            'h5' => null,
        ];

        $key = $this->getPositionFromElementName($element['name']);

        if ($key !== false) {
            $key = $key + 1; // We actually start at h1
            $current['h'.$key] = $element['text'];
            for ($i = ($key + 1); $i <= 5; $i++) {
                $current["h".$i] = null;
            }
            $text['h'.$key] = $element['text'];
            $content = null;
        } else {
            $content = $element['text'];
        }

        $importance = $this->tags[$element['name']];

        return [
            'objectID'      => $locale.'-'.$current_link.'-'.md5($element['text']),
            'h1'            => $current['h1'],
            'h2'            => $current['h2'],
            'h3'            => $current['h3'],
            'h4'            => $current['h4'],
            'h5'            => $current['h5'],
            'text_h1'       => $text['h1'],
            'text_h2'       => $text['h2'],
            'text_h3'       => $text['h3'],
            'text_h4'       => $text['h4'],
            'text_h5'       => $text['h5'],
            'link'          => $current_link,
            'content'       => $content,
            'importance'    => $importance,
            '_tags'         => [$locale]
        ];
    }

    /**
     * Configure settings on the Algolia index.
     *
     * @return void
     */
    public function setSettings()
    {
        $this->index->setSettings([
            'attributesToIndex'         => [
                'unordered(text_h1)', 'unordered(text_h2)', 'unordered(text_h3)', 'unordered(text_h4)', 'unordered(text_h5)',
                'unordered(h1)', 'unordered(h2)', 'unordered(h3)', 'unordered(h4)', 'unordered(h5)', 'unordered(content)'
            ],
            'attributesToHighlight'     => ['h1', 'h2', 'h3', 'h4', 'content'],
            'attributesToRetrieve'      => ['h1', 'h2', 'h3', 'h4', '_tags', 'link'],
            'customRanking'             => ['asc(importance)'],
            'ranking'                   => ['words', 'typo', 'attribute', 'proximity', 'custom'],
            'minWordSizefor1Typo'       => 3,
            'minWordSizefor2Typos'      => 7,
            'allowTyposOnNumericTokens' => false,
            'minProximity'              => 2,
            'ignorePlurals'             => true,
            'advancedSyntax'            => true,
            'removeWordsIfNoResults'    => 'allOptional',
        ]);
    }
}