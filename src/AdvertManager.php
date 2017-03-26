<?php
namespace LudwigHeymbeeck\LaravelAdvert;


use App\Models\Advertisement\Advert\Advert;
use App\Models\Advertisement\Advertcategory\Advertcategory;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\View;
use Illuminate\Support\HtmlString;

class AdvertManager {

    /**
     * @var array
     */
    private $used = [];

    /**
     * @var object;
     */
    private static $instance;

    /**
     * @return AdvertManager
     */
    public static function getInstance()
    {
        return static::$instance ?: (static::$instance = new self());
    }


    /**
     * Search advert by AdvertCategory type
     * If duplicate set to true then it's possible that advert will be the same with
     * previous showed advert
     *
     * @param $type
     * @param bool $duplicate
     * @return HtmlString|string
     */
    public function getHTML($type, $duplicate = false){
        $advert_category = Advertcategory::where('type', $type)->first();
        if(!$advert_category){
            $html = "&nbsp;";
            return new HtmlString($html);
            // return '';
        }

        $advert = $advert_category
            ->adverts()
            ->where('active', true)
            ->where(function($query) use ($duplicate){
                if(!$duplicate){
                    $query->whereNotIn('id', $this->used);
                }
            })
            //->active()
            ->orderByRaw('RAND()') /* display random advert if there are more than one assigned to same category */
            ->first();

        if($advert){
            $advert->plusViews();
            $this->used[$type][] = $advert->id;
            $html = View::make('includes.partials.advert', compact('advert'))->render();
            return new HtmlString($html);
        } else {
            $html = "&nbsp;";
            return new HtmlString($html);
            // return '';
        }
    }

}
