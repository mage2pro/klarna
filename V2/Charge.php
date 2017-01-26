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
	private function kl_order() {return [
		/**
		 * 2017-01-26
		 * «Locale indicative for language & other location-specific details (RFC1766)»
		 * Required: yes.
		 * Type: string.
		 * «Which locales are supported by the version 2 of Klarna Checkout API?»
		 * https://mage2.pro/t/2533
		 */
		'locale' => ''
		/**
		 * 2017-01-26
		 * «Merchant references»
		 * Required: no.
		 * Type: object.
		 * https://developers.klarna.com/en/se/kco-v2/checkout-api#merchant_reference-object-properties
		 */
		,'merchant_reference' => [
			/**
			 * 2017-01-26
			 * «Used for storing merchant's internal order number or other reference.»
			 * Required: no.
			 * Type: string.
			 */
			'orderid1' => ''
			/**
			 * 2017-01-26
			 * «Used for storing merchant's internal order number or other reference.»
			 * Required: no.
			 * Type: string.
			 */
			,'orderid2' => ''
		]
		/**
		 * 2017-01-26
		 * «Country in which the purchase is done (ISO-3166-alpha2)»
		 * Required: yes.
		 * Type: string.
		 */
		,'purchase_country' => ''
		/**
		 * 2017-01-26
		 * «Currency in which the purchase is done (ISO-4217)»
		 * Required: yes.
		 * Type: string.
		 */
		,'purchase_currency' => ''
		/**
		 * 2017-01-26
		 * «Only in Sweden, Norway and Finland:
		 * Indicates whether this purchase is a recurring order»
		 * https://developers.klarna.com/en/se/kco-v2/checkout/use-cases#Recurring-Orders
		 * Required: no.
		 * Type: boolean.
		 */
		,'recurring' => ''
	];}

	/**
	 * 2017-01-26
	 * @return array(string => mixed)
	 */
	public static function p() {return (new self)->kl_order();}
}