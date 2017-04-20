<?php
// 2017-02-04
namespace Dfe\Klarna\Api\Checkout\V2\Charge;
final class Shipping extends Part {
	/**
	 * 2017-02-01
	 * @used-by \Dfe\Klarna\Api\Checkout\V2\Charge::kl_order_lines()
	 * @return array(string => string|int)
	 */
	function p() {return [
		/**
		 * 2017-01-26
		 * «Percentage of discount, multiplied by 100 and provided as an integer.
		 * I.e. 9.57% should be sent as 957.»
		 * Required: no.
		 * Type: integer.
		 */
		'discount_rate' => 0
		/**
		 * 2017-01-26
		 * «The item's International Article Number.
		 * Please note this property is currently not returned when fetching the full order resource.»
		 * Required: no.
		 * Type: string.
		 *
		 * 2017-01-31
		 * По сути, это шрихкод:
		 * https://en.wikipedia.org/wiki/International_Article_Number
		 * https://ru.wikipedia.org/wiki/European_Article_Number
		 */
		,'ean' => ''
		/**
		 * 2017-01-26
		 * «Item image URI.
		 * Please note this property is currently not returned when fetching the full order resource.»
		 * Required: no.
		 * Type: string.
		 *
		 * 2017-02-01
		 * Пока вроде бы Klarna нигде не отображает эту картинку
		 * и не включает это поле в свой ответ с как-бы «полной» информацией о платеже.
		 */
		,'image_uri' => ''
		/**
		 * 2017-01-26
		 * «Name, usually a short description»
		 * Required: yes.
		 * Type: string.
		 */
		,'name' => df_oq_shipping_desc($this->oq())
		/**
		 * 2017-01-26
		 * «Quantity»
		 * Required: yes.
		 * Type: integer.
		 *
		 * 2017-01-31
		 * Используем @used intval(), потому что
		 * @uses \Magento\Sales\Model\Order\Item::getQtyOrdered() возвращает вещественное число,
		 * а не целое, а передача в Klarna вещественного числа приводит к сбою «Bad format».
		 */
		,'quantity' => 1
		/**
		 * 2017-01-26
		 * «Reference, usually the article number»
		 * Required: yes.
		 * Type: string.
		 */
		,'reference' => 'shipping'
		/**
		 * 2017-01-26
		 * «Percentage of tax rate, multiplied by 100 and provided as an integer.
		 * I.e. 13.57% should be sent as 1357.»
		 * Required: yes.
		 * Type: integer.
		 */
		,'tax_rate' => 0
		/**
		 * 2017-01-26
		 * «Type. `physical` by default, alternatively `discount`, `shipping_fee`»
		 * Required: no.
		 * Type: string.
		 *
		 * 2017-02-01
		 * Вот для передачи скидок мы должны использовать значение «discount»,
		 * а для передачи стоимости доставки — значение «shipping_fee».
		 */
		,'type' => 'shipping_fee'
		/**
		 * 2017-01-26
		 * «Unit price in cents, including tax»
		 * Required: yes.
		 * Type: integer.
		 *
		 * 2017-02-01
		 * Замечание №1
		 * Нам тут, согласно спецификации Klarna,
		 * нужна цена именно с налогом, поэтому передаём в df_oqi_price() вторым параметром true.
		 *
		 * Замечание №2
		 * «unit_price» — это стоимость именно единицы товара, а не стоимость позиции заказа.
		 * Проверил это опытным путём, например:
         *   {
         *       <...>
         *       "quantity": 2,
         *       "total_price_excluding_tax": 121892,
         *       "total_price_including_tax": 121892,
         *       "unit_price": 60946
		 *		<...>
         *   }
		 * @uses df_oqi_price() как раз и возвращает стоимость одной единицы товара.
		 *
		 * Замечание №3
		 * Тестовый заказ №376 у нас в шведских кронах.
		 * 10 шведских крон стоят примерно 1 евро.
		 */
		,'unit_price' => $this->amount(df_oq_shipping_amount($this->oq()))
		/**
		 * 2017-01-26
		 * «Item product page URI.
		 * Please note this property is currently not returned when fetching the full order resource.»
		 * Required: no.
		 * Type: string.
		 *
		 * 2017-02-01
		 * Пока вроде бы Klarna нигде не отображает этот адрес
		 * и не включает это поле в свой ответ с как-бы «полной» информацией о платеже.
		 */
		,'uri' => ''
	];}
}