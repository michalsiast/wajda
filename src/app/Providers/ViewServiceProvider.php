<?php


namespace App\Providers;


use App\Models\Page;
use App\Models\PageType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }


    public function boot() {
        if(Schema::hasTable('page')) {
            $this->addPagesToComposer();
        }


        View::composer('default.nav_item.main', 'App\Http\Controllers\NavItemController@partial');
        View::composer('default._helpers.lang_nav', 'App\Http\Controllers\IndexController@langNav');
        View::composer('default.form.contact_form', 'App\Http\Controllers\FormController@showContactForm');


        View::composer('default.article.category.home', 'App\Http\Controllers\ArticleCategoryController@home');
        View::composer('default.article.home', 'App\Http\Controllers\ArticleController@home');

        View::composer('default.offer.category.home', 'App\Http\Controllers\OfferCategoryController@home');
        View::composer('default.offer.home', 'App\Http\Controllers\OfferController@home');

        View::composer('default.realization.category.home', 'App\Http\Controllers\RealizationCategoryController@home');
        View::composer('default.realization.home', 'App\Http\Controllers\RealizationController@home');

        View::composer('default.rotator.base', 'App\Http\Controllers\RotatorController@base');


        View::composer('admin._helpers.nav', 'App\Http\Controllers\Admin\IndexController@nav');
        View::composer('admin._helpers.langs', 'App\Http\Controllers\Admin\IndexController@langs');
        View::composer('admin.field.edit', 'App\Http\Controllers\Admin\EditController@edit');
    }


    private function addPagesToComposer() {
        $items = Page::with([])->activeAndLocale()->get();

        foreach ($items as $item) {
            $type = PageType::getByName($item->type);
            if(!$type['module']) {
                continue;
            }

            [$module, $action] = explode('.', $item->type);
            $controller = $this->controllerFromModuleName($module);
            $controller .= 'Controller';
            $view = str_replace('_', '.', $module);
            $view .= '.'.$action;


//                    dump('controller: '.$controller, 'view: '.$view, 'action: '.$action);
            View::composer(
                'default.'.$view,
                'App\Http\Controllers\\'.$controller.'@'.$action
            );
        }
//        die();
    }

    /*
     * example module name: article_category
     * example controller: ArticleCategory
     * */
    private function controllerFromModuleName($module) {
        $controller = '';
        $slugs = explode('_', $module);

        foreach ($slugs as $slug) {
            $controller .= strtoupper($slug[0]).substr($slug, 1, strlen($slug));
        }

        return $controller;
    }

}
