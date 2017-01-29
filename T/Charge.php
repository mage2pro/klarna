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
			Api::order(S::s(), true ? 'SE' : 'US');
		}
		catch (\Exception $e) {
			echo df_etsd($e);
		}
	}
}