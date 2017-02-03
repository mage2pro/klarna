<?php
// 2017-01-26
namespace Dfe\Klarna\V2;
use Dfe\Klarna\T\Data as Test;
use Magento\Sales\Model\Order as O;
final class Charge {
	/**
	 * 2017-02-01
	 * @used-by olShipping()
	 * @used-by \Dfe\Klarna\V2\Charge\AddDiscount::p()
	 * @used-by \Dfe\Klarna\V2\Charge\Products::p()
	 * @param float $v
	 * @return int
	 */
	final public function amount($v) {return round(100 * df_currency_convert(
		$v, $this->o()->getOrderCurrencyCode(), $this->currency()
	));}

	/**
	 * 2017-02-04
	 * @used-by __construct()
	 * @used-by currency()
	 * @used-by kl_order()
	 * @used-by locale()
	 * @used-by test()
	 * @used-by \Dfe\Klarna\V2\Charge\ShippingAddress::p()
	 * @return string
	 */
	final public function buyerCountry() {return $this->_buyerCountry;}

	/**
	 * 2017-02-02
	 * «sv_SE»
	 * @used-by localeFormatted()
	 * @used-by \Dfe\Klarna\V2\Charge\Products::p()
	 * @return string
	 */
	final public function locale() {return dfc($this, function() {return
		df_locale_by_country($this->buyerCountry())
	;});}

	/**
	 * 2017-02-02
	 * @used-by amount()
	 * @used-by olShipping()
	 * @used-by \Dfe\Klarna\V2\Charge\AddDiscount::p()
	 * @used-by \Dfe\Klarna\V2\Charge\Products::p()
	 * @return O
	 */
	final public function o() {return dfc($this, function() {return df_order_r()->get('376');});}

	/**
	 * 2017-01-30
	 * Замечание №1
	 * Стал использовать @uses dfa(),
	 * потому что некоторые поля обязательны только для некоторых стран
	 * (например, «street_number»).
	 *
	 * Замечание №2
	 * Стал использовать @uses df_nts(),
	 * потому что передача null вместо пустой строки в запросе API
	 * приведёт к ответу сервера «Bad format»
	 * @used-by \Dfe\Klarna\V2\Charge\ShippingAddress::p()
	 * @param string $key
	 * @return string
	 */
	final public function test($key) {return df_nts(dfa(Test::$other[$this->buyerCountry()], $key));}

	/**
	 * 2017-01-29
	 * @used-by p()
	 * @param string $buyerCountry
	 */
	private function __construct($buyerCountry) {$this->_buyerCountry = $buyerCountry;}

	/**
	 * 2017-02-01
	 * @used-by amount()
	 * @used-by kl_order()
	 * @return string
	 */
	private function currency() {return dfc($this, function() {return
		df_currency_by_country_c($this->buyerCountry())
	;});}

	/**
	 * 2017-01-26
	 * «Information about the liable customer of the order.»
	 * Required: no.
	 * Type: customer object.
	 * https://developers.klarna.com/en/se/kco-v2/checkout-api#customer-object-properties
	 * @used-by kl_order()
	 * @return array(string => string)
	 */
	private function kl_customer() {return [
		/**
		 * 2017-01-26
		 * «If provided by customer, or retrieved from national ID.
		 * The customer's birthdate (YYYY-MM-DD)»
		 * Required: no.
		 * Type: string.
		 */
		'date_of_birth' => '1982-07-08'
		/**
		 * 2017-01-26
		 * «Retrieved from national ID or billing_address.title in Germany.
		 * 'female' or 'male'»
		 * Required: no.
		 * Type: string.
		 * 2017-01-27
		 * @todo Почему-то присутствие этого поля приводит к сбою:
		 * «"Bad format: 'gender' is not part of the schema"».
		 * https://mage2.pro/t/2536
		 * https://mail.google.com/mail/u/0/#sent/159e19540307b0cb
		 */
		//,'gender' => 'male'
		/**
		 * 2017-01-26
		 * «For B2B, this field is used for the organization's official registration id
		 * (Organization number).»
		 * Required: no.
		 * Type: string.
		 */
		,'organization_registration_id' => ''
	];}

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
		 * «Additional purchase information required for some industries.»
		 * Required: no.
		 * Type: attachment object.
		 * https://developers.klarna.com/en/se/kco-v2/checkout-api#attachment-object-properties
		 *
		 * 2017-01-28
		 * A list of available attachment types:
		 * https://developers.klarna.com/en/se/kco-v2/checkout-api/attachments
		 */
		'attachment' => (new Charge\Attachment)->p()
		// 2017-01-30
		// Указание здесь поля «billing_address» приведёт к сбою:
		// «The field 'billing_address' is read-only».
		/**
		 * 2017-01-26
		 * «The cart»
		 * Required: yes.
		 * Type: cart object.
		 * https://developers.klarna.com/en/se/kco-v2/checkout-api#cart-object-properties
		 */
		,'cart' => [
			/**
			 * 2017-01-26
			 * «List of cart items»
			 * Required: yes.
			 * Type: array of cart item objects.
			 * https://developers.klarna.com/en/se/kco-v2/checkout-api#cart-item-object-properties
			 *
			 * 2017-02-02
			 * Why does Klarna not show a cart contents to the Norway and Sweden based customers,
			 * but shows it to the all other customers? https://mage2.pro/t/2594
			 * https://mail.google.com/mail/u/0/#sent/159fc6464717d4ab
			 */
			'items' => $this->kl_order_lines()
		]
		/**
		 * 2017-01-26
		 * «Information about the liable customer of the order.»
		 * Required: no.
		 * Type: customer object.
		 * https://developers.klarna.com/en/se/kco-v2/checkout-api#customer-object-properties
		 */
		,'customer' => $this->kl_customer()
		/**
		 * 2017-01-27
		 * «External checkout providers.»
		 * Required: no.
		 * Type: array of external checkout objects.
		 * https://developers.klarna.com/en/se/kco-v2/checkout-api#external_checkout-object-properties
		 */
		,'external_checkouts' => []
		/**
		 * 2017-01-27
		 * «External payment methods.»
		 * Required: no.
		 * Type: array of external payment method objects.
		 * https://developers.klarna.com/en/se/kco-v2/checkout-api#external_payment_method-object-properties
		 */
		,'external_payment_methods' => []
		/**
		 * 2017-01-26
		 * «The gui object»
		 * Required: no.
		 * Type: gui object.
		 * https://developers.klarna.com/en/se/kco-v2/checkout-api#gui-object-properties
		 */
		,'gui' => [
			/**
			 * 2017-01-26
			 * «Layout. `desktop` by default, alternatively `mobile`»
			 * Required: no.
			 * Type: string.
			 */
			'layout' => 'desktop'
			/**
			 * 2017-01-26
			 * «An array of options to define the checkout behaviour.
			 * Supported options `disable_autofocus`.»
			 * Required: no.
			 * Type: array of strings.
			 */
			,'options' => []
		]
		/**
		 * 2017-01-26
		 * «Locale indicative for language & other location-specific details (RFC1766)»
		 * Required: yes.
		 * Type: string.
		 * «Which locales are supported by the version 2 of Klarna Checkout API?»
		 * https://mage2.pro/t/2533
		 * https://developers.klarna.com/en/se/kco-v2/checkout-api#supported-locales
		 *
		 * 2017-01-28
		 * Пустое значение приводит к сбою «Bad format».
		 */
		,'locale' => $this->localeFormatted()
		/**
		 * 2017-01-26
		 * «Merchant related information.»
		 * Required: yes.
		 * Type: merchant object.
		 * https://developers.klarna.com/en/se/kco-v2/checkout-api#merchant-object-properties
		 */
		,'merchant' => (new Charge\Merchant)->p()
		/**
		 * 2017-01-26
		 * «Merchant references»
		 * Required: no.
		 * Type: object.
		 * https://developers.klarna.com/en/se/kco-v2/checkout-api#merchant_reference-object-properties
		 *
		 * 2017-01-28
		 * Bug: if «orderid1» or «orderid2» optional field inside «merchant_reference» is empty,
		 * then an «order» request fails with the message «Bad format»:
		 * https://mage2.pro/t/2542
		 * https://mail.google.com/mail/u/0/#sent/159e514b238a039c
		 */
		,'merchant_reference' => [
			/**
			 * 2017-01-26
			 * «Used for storing merchant's internal order number or other reference.»
			 * Required: no.
			 * Type: string.
			 */
			'orderid1' => '1'
			/**
			 * 2017-01-26
			 * «Used for storing merchant's internal order number or other reference.»
			 * Required: no.
			 * Type: string.
			 */
			,'orderid2' => '1'
		]
		/**
		 * 2017-01-27
		 * «Options for this purchase.»
		 * Required: no.
		 * Type: options object.
		 * https://developers.klarna.com/en/se/kco-v2/checkout/extra-features
		 * https://developers.klarna.com/en/se/kco-v2/checkout-api#options-object-properties
		 */
		,'options' => (new Charge\Options)->p()
		/**
		 * 2017-01-26
		 * «Country in which the purchase is done (ISO-3166-alpha2)»
		 * Required: yes.
		 * Type: string.
		 * https://developers.klarna.com/en/se/kco-v2/checkout-api#supported-locales
		 *
		 * 2017-01-28
		 * Пустое значение приводит к сбою «Bad format».
		 *
		 * 2017-01-29
		 * Помимо этого поля, страна ещё указывается в поле «shipping_address.country»:
		 * https://github.com/mage2pro/klarna/blob/0.0.7/V2/Charge.php?ts=4#L676
		 * https://developers.klarna.com/en/se/kco-v2/checkout-api#address-object-properties
		 */
		,'purchase_country' => $this->buyerCountry()
		/**
		 * 2017-01-26
		 * «Currency in which the purchase is done (ISO-4217)»
		 * Required: yes.
		 * Type: string.
		 * https://developers.klarna.com/en/se/kco-v2/checkout-api#supported-locales
		 *
		 * 2017-01-28
		 * Пустое значение приводит к сбою «Bad format».
		 */
		,'purchase_currency' => $this->currency()
		/**
		 * 2017-01-26
		 * «Only in Sweden, Norway and Finland:
		 * Indicates whether this purchase is a recurring order»
		 * https://developers.klarna.com/en/se/kco-v2/checkout/use-cases#Recurring-Orders
		 * Required: no.
		 * Type: boolean.
		 */
		,'recurring' => false
		/**
		 * 2017-01-26
		 * «The shipping address»
		 * Required: no.
		 * Type: address object.
		 * https://developers.klarna.com/en/se/kco-v2/checkout-api#address-object-properties
		 */
		,'shipping_address' => (new Charge\ShippingAddress($this))->p()
	];}

	/**
	 * 2017-01-26
	 * «List of cart items»
	 * Required: yes.
	 * Type: array of cart item objects.
	 * https://developers.klarna.com/en/se/kco-v2/checkout-api#cart-item-object-properties
	 *
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
	 * @used-by kl_order()
	 * @return array(string => string|int)
	 */
	private function kl_order_lines() {return (new Charge\AddDiscount($this))->p(array_merge(
		(new Charge\Products($this))->p(), df_clean([$this->olShipping()])
	));}

	/**
	 * 2017-02-02
	 * «sv_SE» => «sv-se»
	 * @used-by kl_order()
	 * @return string
	 */
	private function localeFormatted() {return str_replace('_', '-', strtolower($this->locale()));}

	/**
	 * 2017-02-01
	 * @used-by kl_order_lines()
	 * @return array(string => string|int)
	 */
	private function olShipping() {return [
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
		,'name' => $this->o()->getShippingDescription()
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
		 *
		 * Замечание №3
		 * Тестовый заказ №376 у нас в шведских кронах.
		 * 10 шведских крон стоят примерно 1 евро.
		 */
		,'unit_price' => $this->amount($this->o()->getShippingAmount())
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

	/**
	 * 2017-01-29
	 * @used-by __construct()
	 * @used-by buyerCountry()
	 * @var string
	 */
	private $_buyerCountry;

	/**
	 * 2017-01-26
	 * @param string $buyerCountry
	 * @return array(string => mixed)
	 */
	public static function p($buyerCountry) {return (new self($buyerCountry))->kl_order();}
}