<?php

namespace App;

use App\Contracts\LocaleInterface;
use Illuminate\Translation\Translator;

class Locale implements LocaleInterface
{
    /**
     * @var Translator
     */
    protected $tranlator;

    /**
     * Locale constructor.
     *
     * @param Translator $translator
     */
    public function __construct(Translator $translator)
    {
        $this->tranlator = $translator;
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
        return $this->tranlator->getLocale();
    }

    /**
     * @return string
     */
    public function getDocsLocalePrefix()
    {
        return $this->getCurrent().'/';
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
        $request = request();

        $host = $request->getHttpHost();
        $segments = explode('.', $host);

        if ($locale == 'ru') {
            if (count($segments) == 3) {
                array_shift($segments);
            }
        } else {
            if (count($segments) > 2 && in_array($segments[0], $this->getAvailableLocales())) {
                $segments[0] = $locale;
            } else {
                array_unshift($segments, $locale);
            }
        }

        return url($request->getScheme().'://'.implode('.', $segments).$request->getPathInfo());
    }
}