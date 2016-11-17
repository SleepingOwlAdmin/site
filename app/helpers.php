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