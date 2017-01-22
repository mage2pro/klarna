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
			'order_lines' => [
				[
					'name' => 'Tomatoes'
					,'quantity' => 10
					,'quantity_unit' => 'kg'
					/**
					 * 2017-01-22
					 * «Article number, SKU or similar.»
					 * https://developers.klarna.com/api/#checkout-api__order__order_lines__reference
					 */
					,'reference' => '123050'
					/**
					 * 2017-01-22
					 * «Order line type. Possible values: digital, discount, gift_card, physical,
					 * sales_tax, shipping_fee, store_credit, surcharge.»
					 * https://developers.klarna.com/api/#checkout-api__order__order_lines__type
					 */
					,'type' => 'physical'
					,'unit_price' => 600
					,'tax_rate' => 2500
					,'total_amount' => 6000
					,'total_tax_amount' => 1200
				]
			]
		];
	}
}