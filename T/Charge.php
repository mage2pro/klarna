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
				/**
				 * 2017-01-30
				 * It seems like Denmark is not supported yet:
				 * «[Klarna][Checkout v2] Why does an order API request for Denmark
				 * lead to the «not_accepted_purchase_country» response?»
				 * https://mage2.pro/t/2559
				 */
				foreach (['at', 'de', 'fi', 'no', 'se'] as $c) {
					/** @var string $c */
					file_put_contents(BP . "/_my/Klarna/{$c}.html", Api::order(S::s(), strtoupper($c)));
					echo df_country_ctn($c) . " OK\n";
				}
			}
		}
		catch (\Exception $e) {
			echo df_etsd($e);
		}
	}
}