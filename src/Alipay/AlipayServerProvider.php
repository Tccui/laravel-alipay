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
		//$this->setupConfig();
	}

	/**
	 * Setup the config.
	 *
	 * @return void
	 */
	protected function setupConfig()
	{
		$source_config = realpath(__DIR__ . '/../../config/config.php');
		$source_mobile = realpath(__DIR__ . '/../../config/mobile.php');
		$source_web = realpath(__DIR__ . '/../../config/web.php');
		if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
			$this->publishes([
				$source_config => config_path('latrell-alipay.php'),
				$source_mobile => config_path('latrell-alipay-mobile.php'),
				$source_web => config_path('latrell-alipay-web.php'),
			]);
		} elseif ($this->app instanceof LumenApplication) {
			$this->app->configure('latrell-alipay');
			$this->app->configure('latrell-alipay-mobile');
			$this->app->configure('latrell-alipay-web');
		}
		
		$this->mergeConfigFrom($source_config, 'latrell-alipay');
		$this->mergeConfigFrom($source_mobile, 'latrell-alipay-mobile');
		$this->mergeConfigFrom($source_web, 'latrell-alipay-web');
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

