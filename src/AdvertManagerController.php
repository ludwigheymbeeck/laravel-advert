<?php

namespace LudwigHeymbeeck\LaravelAdvert;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Advertisement\Advert\Advert;

use App\Http\Requests;

class AdvertManagerController extends Controller
{

    /**
     * Simple controller method to add clicks count
     *
     *
     * @param $advert_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index($advert_id){
        $advert = Advert::findOrFail($advert_id);
        $advert->plusClicks();

        return redirect($advert->url);
    }
}
