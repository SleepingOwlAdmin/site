<?php

namespace App\Http\Controllers;

use App\Contracts\LocaleInterface;

class HomeController extends Controller
{
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if(view()->exists($view = $this->locale->getCurrent().'.marketing')) {
            return view($view);
        }

        return view(
            'marketing'
        );
    }
}