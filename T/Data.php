<?php
// 2017-01-31
namespace Dfe\Klarna\T;
use Magento\Sales\Model\Order as O;
final class Data {
	/**
	 * 2017-01-31
	 * @return O
	 */
	public static function order() {return dfcf(function() {return df_order_r()->get('376');});}

	/**
	 * 2017-01-30
	 * «[Klarna] Test addresses» https://mage2.pro/t/2555
	 * @used-by \Dfe\Klarna\V2\Charge::test()
	 * @var array(string => array(string => string|int))
	 */
	public static $other = [
		'AT' => [
			'city' => 'Vienna'
			,'phone' => '+43 1 22 7800'
			,'postal_code' => '1010'
			,'street_name' => 'Herrengasse'
			,'street_number' => 12
		]
		,'DE' => [
			'city' => 'Berlin'
			,'phone' => '+49 30 238 280'
			,'postal_code' => '10178'
			,'street_name' => 'Karl-Liebknecht-Strasse'
			,'street_number' => 3
		]
		/**
		 * 2017-01-30
		 * It seems like Denmark is not supported yet:
		 * «[Klarna][Checkout v2] Why does an order API request for Denmark
		 * lead to the «not_accepted_purchase_country» response?»
		 * https://mage2.pro/t/2559
		 */
		,'DK' => ['postal_code' => '00100']
		,'FI' => [
			'city' => 'Helsinki'
			,'phone' => '+358 20 1234 701'
			,'postal_code' => '00100'
			,'street_address' => 'Runeberginkatu 2'
		]
		,'NO' => [
			'city' => 'Oslo'
			,'phone' => '+47 22 058000'
			,'postal_code' => '0185'
			,'street_address' => 'Sonja Henies plass 3'
		]
		,'SE' => [
			'city' => 'Stockholm'
			,'phone' => '+46 8 5050 6000'
			,'postal_code' => '111 22'
			,'street_address' => 'Nils Ericsons Plan 4'
		]
	];
}