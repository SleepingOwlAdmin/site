<?php

/**
 * @return \App\Contracts\LocaleInterface
 */
function locale()
{
    return app(\App\Contracts\LocaleInterface::class);
}