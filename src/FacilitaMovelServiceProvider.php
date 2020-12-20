<?php

namespace NotificationChannels\FacilitaMovel;

use Illuminate\Support\ServiceProvider;

class FacilitaMovelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // Bootstrap code here.
        $this->app->when(FacilitaMovelChannel::class)
            ->needs(FacilitaMovel::class)
            ->give(function () {
                $config = config('services.facilitamovel');
                return new FacilitaMovel(
                    $config['login'],
                    $config['password']
                );
            });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
