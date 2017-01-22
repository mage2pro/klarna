<?php
// 2017-01-22
namespace Dfe\Klarna\T;
class Charge extends \Df\Core\TestCase {
	/**
	 * @test
	 * 2017-01-22
	 */
	public function t00() {}

	/**
	 * @test
	 * 2017-01-22
	 */
	public function t01() {
		/**
		 * 2017-01-22
		 * https://developers.klarna.com/en/us/kco-v3/checkout/2-render-the-checkout#add-cart-items
		 * @var array(String => mixed) $params
		 */
		$params = [
			// 2017-01-22
			// «The applicable order lines (max 1000).»
			// required
			// https://developers.klarna.com/api/#checkout-api__order__order_lines
			'order_lines' => [$this->item()]
		];
	}

	/**
	 * 2017-01-22
	 * https://developers.klarna.com/api/#checkout-api__order__order_lines
	 * @return array(string => string|int)
	 */
	private function item() {return [
		/**
		 * 2017-01-22
		 * «Descriptive item name.»
		 * Required: yes.
		 * string
		 * https://developers.klarna.com/api/#checkout-api__order__order_lines__name
		 */
		'name' => 'Tomatoes'
		/**
		 * 2017-01-22
		 * «Non-negative. The item quantity.»
		 * Required: yes.
		 * integer
		 * https://developers.klarna.com/api/#checkout-api__order__order_lines__quantity
		 */
		,'quantity' => 10
		/**
		 * 2017-01-22
		 * «Unit used to describe the quantity, e.g. kg, pcs...
		 * If defined has to be 1-8 characters.»
		 * Required: no.
		 * string
		 * https://developers.klarna.com/api/#checkout-api__order__order_lines__quantity_unit
		 */
		,'quantity_unit' => 'kg'
		/**
		 * 2017-01-22
		 * «Article number, SKU or similar.»
		 * Required: no.
		 * string
		 * https://developers.klarna.com/api/#checkout-api__order__order_lines__reference
		 */
		,'reference' => '123050'
		/**
		 * 2017-01-22
		 * «Order line type. Possible values: digital, discount, gift_card, physical,
		 * sales_tax, shipping_fee, store_credit, surcharge.»
		 * Required: no.
		 * string
		 * https://developers.klarna.com/api/#checkout-api__order__order_lines__type
		 */
		,'type' => 'physical'
		/**
		 * 2017-01-22
		 * «Non-negative. In percent, two implicit decimals. I.e 2500 = 25%.»
		 * Required: yes.
		 * integer
		 * https://developers.klarna.com/api/#checkout-api__order__order_lines__tax_rate
		 */
		,'tax_rate' => 2500
		/**
		 * 2017-01-22
		 * «Includes tax and discount.
		 * Must match (quantity unit_price) - total_discount_amount within ±quantity.
		 * (max value: 100000000)»
		 * Required: true.
		 * integer
		 * https://developers.klarna.com/api/#checkout-api__order__order_lines__total_amount
		 */
		,'total_amount' => 6000
		/**
		 * 2017-01-22
		 * «Non-negative minor units. Includes tax.»
		 * Required: no.
		 * integer
		 * https://developers.klarna.com/api/#checkout-api__order__order_lines__total_discount_amount
		 */
		,'total_discount_amount' => 0
		/**
		 * 2017-01-22
		 * «STUB.»
		 * Required: ?.
		 */
		,'total_tax_amount' => 1200
		/**
		 * 2017-01-22
		 * «Minor units. Includes tax, excludes discount. (max value: 100000000)»
		 * Required: yes.
		 * integer
		 * https://developers.klarna.com/api/#checkout-api__order__order_lines__unit_price
		 */
		,'unit_price' => 600
	];}
}