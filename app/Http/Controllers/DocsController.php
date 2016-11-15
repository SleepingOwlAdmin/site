<?php

namespace App\Http\Controllers;

use App\Documentation;
use Symfony\Component\DomCrawler\Crawler;

class DocsController extends Controller
{
    /**
     * The documentation repository.
     *
     * @var Documentation
     */
    protected $docs;

    /**
     * Create a new controller instance.
     *
     * @param  Documentation  $docs
     * @return void
     */
    public function __construct(Documentation $docs)
    {
        $this->docs = $docs;
    }

    /**
     * Show the root documentation page (/docs).
     *
     * @return Response
     */
    public function showRootPage()
    {
        return $this->show();
    }

    /**
     * Show a documentation page.
     *
     * @param string|null $page
     *
     * @return Response
     */
    public function show($page = null)
    {
        $sectionPage = $page ?: 'installation';
        $content = $this->docs->get($sectionPage);

        if (is_null($content)) {
            abort(404);
        }

        $title = (new Crawler($content))->filterXPath('//h1');

        $section = '';

        if ($this->docs->sectionExists($page)) {
            $section .= '/'.$page;
        } elseif (! is_null($page)) {
            return redirect('/docs');
        }

        $canonical = null;

        if ($this->docs->sectionExists($sectionPage)) {
            $canonical = 'docs/'.$sectionPage;
        }

        return view('docs', [
            'title' => count($title) ? utf8_decode($title->text()) : null,
            'index' => $this->docs->getIndex().' | Документация',
            'content' => $content,
            'currentSection' => $section,
            'canonical' => $canonical,
        ]);
    }
}
