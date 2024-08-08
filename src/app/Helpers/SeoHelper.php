<?php


namespace App\Helpers;


use Artesaos\SEOTools\Facades\SEOMeta;

abstract class SeoHelper
{
    public static function setSeo($seo) {
        SEOMeta::setTitle($seo->title);
        SEOMeta::setDescription($seo->description);
        SEOMeta::addKeyword($seo->tags);
    }
}
