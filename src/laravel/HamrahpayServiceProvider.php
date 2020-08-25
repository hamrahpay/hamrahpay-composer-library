<?php

namespace Hamrahpay\Laravel;

use Illuminate\Support\ServiceProvider;

use Hamrahpay\Hamrahpay;

class HamrahpayServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton('Hamrahpay', function () {
            // 
            $API_Key = config('services.hamrahpay.API_Key', config('Hamrahpay.API_Key', 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx'));
            $hamrahpay = new Hamrahpay($API_Key);
            return $hamrahpay;
        });
    }

    /**
     * Publish the plugin configuration.
     */
    public function boot()
    {
        //
    }
}