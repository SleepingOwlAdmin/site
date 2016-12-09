<?php

namespace App\Http\Controllers;

use App\Contracts\LocaleInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var LocaleInterface
     */
    private $locale;

    /**
     * HomeController constructor.
     *
     * @param LocaleInterface $locale
     */
    public function __construct(LocaleInterface $locale)
    {
        $this->locale = $locale;
    }

    /**
     * @param $template
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function view($template)
    {
        if (view()->exists($localeTemplate = $this->locale->getCurrent().'.'.$template)) {
            return view($localeTemplate);
        }

        return view($template);
    }
}
