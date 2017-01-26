<?php
// 2017-01-26
namespace Dfe\Klarna\V2;
class Charge {
	/**
	 * 2017-01-26
	 * https://developers.klarna.com/en/se/kco-v2/checkout-api#resource-properties
	 * https://developers.klarna.com/en/se/kco-v2/checkout/2-embed-the-checkout#configure-checkout-order
	 * @used-by p()
	 * @return array(string => mixed)
	 */
	private function kl_order() {return [];}

	/**
	 * 2017-01-26
	 * @return array(string => mixed)
	 */
	public static function p() {return (new self)->kl_order();}
}