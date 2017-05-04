<?php
namespace Alipay;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application as LaravelApplication;
use Laravel\Lumen\Application as LumenApplication;

class AlipayServiceProvider extends ServiceProvider
{

	/**
	 * boot process
	 */
	public function boot()
	{
	}


	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		
		$this->app->bind('alipay.AopClient', function ($app)
		{
			$class = new AopClient();

			return $class;
		});
                $this->app->bind('alipay.TradeAppPayRequest', function ($app)
                {
                        $class = new Request\AlipayTradeAppPayRequest();

                        return $class;
                });

		
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [
                        'alipay.AopClient',
                        'alipay.TradeAppPayRequest'
		];
	}
}

