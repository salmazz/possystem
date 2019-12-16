<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LangController extends Controller
{
    //

    public function setLocale($locale)
{
    if(in_array($locale, $locales)) {
        App:: setLocale($locale);
    }

    return redirect()->back();
}
}
