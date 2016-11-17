<?php

/**
 * Convert some text to Markdown...
 *
 * @param string $text
 *
 * @return string
 */
function markdown($text)
{
    return (new ParsedownExtra)->text($text);
}


/**
 * @return \App\Contracts\LocaleInterface
 */
function locale()
{
    return app(\App\Contracts\LocaleInterface::class);
}

/**
 * SVG helper
 *
 * @param string $src Path to svg in the cp image directory
 * @return string
 */
function svg($src)
{
    return file_get_contents(public_path('assets/svg/' . $src . '.svg'));
}
