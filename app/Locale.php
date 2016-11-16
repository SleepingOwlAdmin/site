<?php

namespace App;

use App\Contracts\LocaleInterface;
use Illuminate\Translation\Translator;

class Locale implements LocaleInterface
{
    /**
     * @var string
     */
    protected $currentLocale;

    /**
     * Locale constructor.
     *
     * @param Translator $translator
     */
    public function __construct(Translator $translator)
    {
        $this->currentLocale = $translator->getLocale();
    }

    /**
     * @return array
     */
    public function getAvailableLocales()
    {
        return config('app.available_locales', ['ru']);
    }

    /**
     * @return string
     */
    public function getCurrent()
    {
        return $this->currentLocale;
    }

    /**
     * @return string
     */
    public function getDocsLocalePrefix()
    {
        if ($this->currentLocale == 'ru') {
            return '';
        }

        return  $this->currentLocale.'/';
    }

    /**
     * @return array
     */
    public function getAvailableLocalesWithHosts()
    {
        $locales = [];

        foreach ($this->getAvailableLocales() as $locale) {
            $locales[$locale] = $this->buildLocalHost($locale);
        }

        return $locales;
    }

    /**
     * @param string $locale
     *
     * @return string
     */
    protected function buildLocalHost($locale)
    {
        if ($locale == 'ru') {
            return url()->current();
        }

        $request = request();

        $host = $request->getHttpHost();
        $segments = explode('.', $host);

        if (count($segments) > 2 && in_array($segments[0], $this->getAvailableLocales())) {
            $segments[0] = $locale;
        } else {
            array_unshift($segments, $locale);
        }

        return url($request->getScheme().'://'.implode('.', $segments).$request->getPathInfo());
    }
}