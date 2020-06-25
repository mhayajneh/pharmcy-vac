<?php

namespace App\Services\MobileCause;

use App\Setting;
use Illuminate\Support\ServiceProvider;

class MobileCauseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('mobilecause', function () {
          if($token = config('mobilecause.token')) {
            throw new TokenNotFoundException;
          }

          $connection = new Connection($token);

          $manager = new Manager($connection, $this->config());

          return $manager->make();
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function config()
    {
        return [
          'campaign_name' => optional(Setting::find('campaign.name'))->value,
          'campaign_start_date' => optional(Setting::find('campaign.start_date'))->value,
          'campaign_end_date' => optional(Setting::find('campaign.end_date'))->value
        ];
    }
}
