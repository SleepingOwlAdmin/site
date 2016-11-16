<?php

namespace App\Contracts;

interface LocaleInterface
{
    /**
     * @return array
     */
    public function getAvailableLocales();

    /**
     * @return string
     */
    public function getCurrent();

    /**
     * @return string
     */
    public function getDocsLocalePrefix();
}