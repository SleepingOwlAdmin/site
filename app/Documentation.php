<?php

namespace App;

use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\Translator;

class Documentation
{
    /**
     * The filesystem implementation.
     *
     * @var Filesystem
     */
    protected $files;

    /**
     * The cache implementation.
     *
     * @var Cache
     */
    protected $cache;

    /**
     * @var string
     */
    protected $locale;

    /**
     * @var string
     */
    protected $localePath;

    /**
     * Create a new documentation instance.
     *
     * @param  Filesystem $files
     * @param  Cache $cache
     * @param Translator $translator
     */
    public function __construct(Filesystem $files, Cache $cache, Translator $translator)
    {
        $this->files = $files;
        $this->cache = $cache;
        $this->locale = $translator->getLocale();

        if ($this->locale == 'ru') {
            $this->localePath = '';
        } else {
            $this->localePath = $this->locale.'/';
        }
    }

    /**
     * Get the documentation index page.
     *
     * @return string
     */
    public function getIndex()
    {
        return $this->cache->remember('docs.index.'.$this->locale, 5, function () {
            $path = base_path('resources/docs/'.$this->localePath.'documentation.md');

            if ($this->files->exists($path)) {
                return $this->replaceLinks($this->locale, markdown($this->files->get($path)));
            }

            return null;
        });
    }

    /**
     * Get the given documentation page.
     *
     * @param  string  $page
     * @return string
     */
    public function get($page)
    {
        return $this->cache->remember('docs.'.$page.'.'.$this->locale, 5, function () use ($page) {
            $path = base_path('resources/docs/'.$this->localePath.$page.'.md');

            if ($this->files->exists($path)) {
                return $this->replaceLinks($this->locale, markdown($this->files->get($path)));
            }

            return null;
        });
    }

    /**
     * Replace the version place-holder in links.
     *
     * @param string $locale
     * @param string $content
     *
     * @return string
     */
    public static function replaceLinks($locale, $content)
    {
        $content = preg_replace('/href=\"([a-z0-0\-\_]+)\"/i', 'href="/docs/$1"', $content);

        return $content;
    }

    /**
     * Check if the given section exists.
     *
     * @param  string  $page
     * @return boolean
     */
    public function sectionExists($page)
    {
        return $this->files->exists(
            base_path('resources/docs/'.$this->localePath.$page.'.md')
        );
    }
}
