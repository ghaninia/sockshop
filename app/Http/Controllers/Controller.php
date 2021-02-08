<?php

namespace App\Http\Controllers;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Support\Facades\URL;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function seo(array $info = null)
    {

        $description = $info["desc"] ?? config("site.description");
        $title = $info["title"] ?? config("site.title");
        $createdTime = $info["article"]["created_at"] ?? null;
        $category = $info["article"]["category"] ?? null;
        $cover = $info["article"]["cover"] ?? null;
        $keywords = $info["keywords"] ?? config("site.keywords");
        $locale = config("app.locale");

        $title = is_array($title) ? implode(" | ", $title) : $title;

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::addMeta('article:published_time', $createdTime, 'property');
        SEOMeta::addMeta('article:section', $category, 'property');
        SEOMeta::setKeywords($keywords);

        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::setUrl(URL::current());
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('locale', $locale);
        OpenGraph::addProperty('locale:alternate', [$locale]);
        OpenGraph::addImage($cover);

        JsonLd::setTitle($title);
        JsonLd::setDescription($description);
        JsonLd::setType('Article');
        JsonLd::addImage($cover);
    }
}
