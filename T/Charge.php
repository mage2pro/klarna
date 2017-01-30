<?php
// 2017-01-22
namespace Dfe\Klarna\T;
use Dfe\Klarna\Api;
use Dfe\Klarna\Settings as S;
class Charge extends \Df\Core\TestCase {
	/**
	 * @test
	 * 2017-01-22
	 */
	public function t01() {
		try {
			/**
			 * 2017-01-30
			 * Доступов к API версии 3 у меня всё ещё нет:
			 * «How to get test credentials for the version 3 of Klarna Checkout API?»
			 * https://mage2.pro/t/2531/3
			 * «If anybody from USA or United Kingdom needs my Klarna payment extension,
			 * then please provide me a test account»: https://mage2.pro/t/2554
			 */
			if (false) {
				Api::order(S::s(), 'US');
			}
			else {
				echo implode("\n\n", df_map(function($c) {return
					df_cc_n(df_country_ctn($c), Api::order(S::s(), $c))
				;}, ['SE', 'FI']));
			}
		}
		catch (\Exception $e) {
			echo df_etsd($e);
		}
	}
}