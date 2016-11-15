<?php

namespace App;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Cache\Repository as Cache;

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
     * Create a new documentation instance.
     *
     * @param  Filesystem  $files
     * @param  Cache  $cache
     * @return void
     */
    public function __construct(Filesystem $files, Cache $cache)
    {
        $this->files = $files;
        $this->cache = $cache;
    }

    /**
     * Get the documentation index page.
     *
     * @return string
     */
    public function getIndex()
    {
        return $this->cache->remember('docs.index', 5, function () {
            $path = base_path('resources/docs/documentation.md');

            if ($this->files->exists($path)) {
                return $this->replaceLinks(markdown($this->files->get($path)));
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
        return $this->cache->remember('docs.'.$page, 5, function () use ($page) {
            $path = base_path('resources/docs/'.$page.'.md');

            if ($this->files->exists($path)) {
                return $this->replaceLinks(markdown($this->files->get($path)));
            }

            return null;
        });
    }

    /**
     * Replace the version place-holder in links.
     *
     * @param  string  $content
     * @return string
     */
    public static function replaceLinks($content)
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
            base_path('resources/docs/'.$page.'.md')
        );
    }
}
