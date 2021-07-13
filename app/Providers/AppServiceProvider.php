<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;
use EasyWeChat\Factory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('wechat.pay', function () {
            $config = config('wechat.payment.default');
            $config['cert_path'] = storage_path('wechat_pay/apiclient_cert.pem');
            $config['key_path'] = storage_path('wechat_pay/apiclient_key.pem');
            $config['notify_url'] = route('api.v1.payment.wechat.notify');

            return Factory::payment($config);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        JsonResource::withoutWrapping();
    }
}
