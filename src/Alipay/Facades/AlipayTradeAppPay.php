<?php

namespace Alipay\Facades;

use Illuminate\Support\Facades\Facade;

class AlipayTradeAppPay extends Facade
{

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'alipay.TradeAppPayRequest';
	}
}
