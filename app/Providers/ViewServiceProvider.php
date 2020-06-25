<?php

namespace App\Providers;

use App\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
      View::composer(
        ['layouts.header', 'auth.*'],
          function ($view) {
          $setting = Setting::find('site.logo.url');

          $url = $setting ? $setting->value : 'https://placeholder.com/wp-content/uploads/2018/10/placeholder.com-logo1.png';

          $view->with('logo_url', $url);
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
