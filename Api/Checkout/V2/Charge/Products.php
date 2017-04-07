<?php
namespace Dfe\Klarna\Api\Checkout\V2\Charge;
use Magento\Sales\Model\Order\Item as OI;
// 2017-02-04
final class Products extends Part {
	/**
	 * 2017-01-31
	 * Примеры аналогичной функциональности в других моих платёжных модулях:
	 *
	 * *) @see \Dfe\AllPay\Charge::productUrls()
	 * https://github.com/mage2pro/allpay/blob/1.1.25/Charge.php?ts=4#L648-L650
	 *
	 * *) @see \Dfe\CheckoutCom\Charge::setProducts()
	 * https://github.com/checkout/checkout-magento2-plugin/blob/1.1.19/Charge.php?ts=4#L413-L423
	 *
	 * *) @see \Dfe\TwoCheckout\Charge::lineItems()
	 * https://github.com/mage2pro/2checkout/blob/1.1.16/Charge.php?ts=4#L153-L183
	 *
	 * @used-by \Dfe\Klarna\Api\Checkout\V2\Charge::kl_order_lines()
	 * @return array(string => string|int)
	 */
	function p() {return df_oi_leafs($this->o(), function(OI $i) {return [
		/**
		 * 2017-01-26
		 * «Percentage of discount, multiplied by 100 and provided as an integer.
		 * I.e. 9.57% should be sent as 957.»
		 * Required: no.
		 * Type: integer.
		 *
		 * 2017-02-02
		 * Замечание №1
		 * При заказе настраиваемого товара, Magento хранит скидку только у товара-родителя,
		 * но не у прострого варианта настраиваемого товара.
		 *
		 * Замечание №2
		 * Указанная здесь скидка не входит в «unit_price»:
		 * Klarna вычтет её из «unit_price»: https://mage2.pro/t/2592
		 * По этой причине неверно использовать здесь
		 * round(100 * df_oi_top($i)->getDiscountPercent()),
		 * потому что в Magento @see \Magento\Sales\Model\Order\Item::getDiscountPercent()
		 * возвращает скидку, уже включённую в
		 * @see \Magento\Sales\Model\Order\Item::getPriceInclTax()
		 *
		 * Вообще, похоже нет смысла тут передавать скидку в Klarna.
		 * Пока, по крайней мере, мне смысл неочевиден.
		 * Спросил у техподдержки:
		 * What is the advantage to pass the «discount_rate» parameter with a cart item
		 * instead of including this discount into the «unit_price» parameter?
		 * https://mage2.pro/t/2593
		 * https://mail.google.com/mail/u/0/#sent/159fc5b467f83428
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
		 *
		 * 2017-02-02
		 * What is the purpose to pass the EANs (European Article Numbers)
		 * of the ordered products to Klarna?  https://mage2.pro/t/2591
		 * https://mail.google.com/mail/u/0/#sent/159fbd9e16cbdff5
		 */
		,'ean' => '2400000032632'
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
		,'image_uri' => df_oi_image($i)
		/**
		 * 2017-01-26
		 * «Name, usually a short description»
		 * Required: yes.
		 * Type: string.
		 */
		,'name' => $i->getName()
		/**
		 * 2017-01-26
		 * «Quantity»
		 * Required: yes.
		 * Type: integer.
		 *
		 * 2017-01-31
		 * Передача в Klarna вещественного числа приводит к сбою «Bad format».
		 */
		,'quantity' => df_oi_qty($i)
		/**
		 * 2017-01-26
		 * «Reference, usually the article number»
		 * Required: yes.
		 * Type: string.
		 */
		,'reference' => $i->getSku()
		/**
		 * 2017-01-26
		 * «Percentage of tax rate, multiplied by 100 and provided as an integer.
		 * I.e. 13.57% should be sent as 1357.»
		 * Required: yes.
		 * Type: integer.
		 */
		,'tax_rate' => df_oi_tax_rate($i, true)
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
		,'type' => 'physical'
		/**
		 * 2017-01-26
		 * «Unit price in cents, including tax»
		 * Required: yes.
		 * Type: integer.
		 *
		 * 2017-02-01
		 * Замечание №1
		 * Нам тут, согласно спецификации Klarna,
		 * нужна цена именно с налогом, поэтому передаём в df_oi_price() вторым параметром true.
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
		 * @uses df_oi_price() как раз и возвращает стоимость одной единицы товара.
		 */
		,'unit_price' => $this->amount(df_oi_price($i, true))
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
		,'uri' => df_oi_url($i)
	];}, $this->owner()->locale());}
}