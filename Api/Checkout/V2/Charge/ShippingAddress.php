<?php
# 2017-02-04
namespace Dfe\Klarna\Api\Checkout\V2\Charge;
final class ShippingAddress extends Part {
	/**
	 * 2017-01-26
	 * «The shipping address»
	 * Type: address object.
	 * https://developers.klarna.com/en/se/kco-v2/checkout-api#address-object-properties
	 * @used-by \Dfe\Klarna\Api\Checkout\V2\Charge::kl_order()
	 * @return array(string => string)
	 * Похоже, что при использовании Checkout API версии 2
	 * мы не можем передать адрес покупателя сервису,
	 * потому что «billing_address» полностью read-only,
	 * а у «shipping_address» все важные для нас поля read-only.
	 * @todo Надо всё-таки проверить, попытаться что-то передать (имя, фамилию...).
	 * В то же время, Checkout API версии 3 позвляет нам передавать сервису «billing_address»:
	 * https://developers.klarna.com/api/?json#checkout-api__order__billing_address
	 * 2017-01-28 Передача пустого массива приводит к сбою «Bad format».
	 */
	function p():array {return [
		/**
		 * 2017-01-28
		 * «c/o»
		 * Required: no.
		 * Type: string.
		 * Спецификация помечает это поле как «read only»,
		 * но на практике я установил, что веб-сервис его допускает.
		 * https://www.reference.com/education/send-letter-care-someone-else-7fcf5853954e000c
		 */
		'care_of' => ''
		/**
		 * 2017-01-28
		 * «City»
		 * Required: no.
		 * Type: string.
		 * Спецификация помечает это поле как «read only»,
		 * но на практике я установил, что веб-сервис его допускает.
		 *
		 * 2017-01-30
		 * [Klarna][Checkout v2] How is the «shipping_address.city» field shown on the payment form?
		 * https://mage2.pro/t/2567
		 */
		,'city' => $this->test('city')
		/**
		 * 2017-01-28
		 * «Country (ISO-3166 alpha)»
		 * Required: yes.
		 * Type: string.
		 *
		 * Замечание №1
		 * Спецификация помечает это поле как «read only»,
		 * но на практике я установил, что веб-сервис его допускает.
		 *
		 * Замечание №2
		 * Передача пустого значения приводит к сбою «Bad format».
		 *
		 * 2017-01-29
		 * Помимо этого поля, страна ещё указывается в поле «purchase_country»:
		 * https://github.com/mage2pro/klarna/blob/0.0.7/V2/Charge.php?ts=4#L503
		 * https://developers.klarna.com/en/se/kco-v2/checkout-api#resource-properties
		 */
		,'country' => $this->owner()->bCountry()
		/**
		 * 2017-01-28
		 * «E-mail address»
		 * Required: no.
		 * Type: string.
		 *
		 * 2017-01-29
		 * Веб-сервис использует значение этого поля
		 * для автоматического заполнения платёжной формы.
		 */
		,'email' => 'admin@mage2.pro'
		/**
		 * 2017-01-28
		 * «Last name»
		 * Required: no.
		 * Type: string.
		 * Спецификация помечает это поле как «read only»,
		 * но на практике я установил, что веб-сервис его допускает.
		 */
		,'family_name' => 'Fedyuk'
		/**
		 * 2017-01-28
		 * «First name»
		 * Required: no.
		 * Type: string.
		 * Спецификация помечает это поле как «read only»,
		 * но на практике я установил, что веб-сервис его допускает.
		 */
		,'given_name' => 'Dmitry'
		/**
		 * 2017-01-28
		 * «Only for B2B orders. The name of the organization placing the order.»
		 * Required: no.
		 * Type: string.
		 * Спецификация помечает это поле как «read only»,
		 * но на практике я установил, что веб-сервис его допускает.
		 */
		,'organization_name' => ''
		/**
		 * 2017-01-28
		 * «Phone number»
		 * Required: no.
		 * Type: string.
		 * Спецификация помечает это поле как «read only»,
		 * но на практике я установил, что веб-сервис его допускает.
		 *
		 * 2017-01-31
		 * [Klarna][Checkout v2] How is the «shipping_address.phone» field shown on the payment form?
		 * https://mage2.pro/t/2568
		 */
		,'phone' => $this->test('phone')
		/**
		 * 2017-01-28
		 * «Postal code»
		 * Required: no.
		 * Type: string.
		 *
		 * 2017-01-29
		 * Веб-сервис использует значение этого поля
		 * для автоматического заполнения платёжной формы.
		 */
		,'postal_code' => $this->test('postal_code')
		/**
		 * 2017-01-28
		 * «Only for B2B orders.
		 * Reference information entered by the customer for this B2B order.»
		 * Required: no.
		 * Type: string.
		 * Использование поля «reference» приводит к сбою «Bad format»: https://mage2.pro/t/2541
		 */
		//,'reference' => ''
		/**
		 * 2017-01-28
		 * «Only in Sweden, Norway and Finland:
		 * Street address (street name, street number, street extension).»
		 * Required: no.
		 * Type: string.
		 *
		 * Замечание №1
		 * Спецификация помечает это поле как «read only»,
		 * но на практике я установил, что веб-сервис его допускает.
		 *
		 * Замечание №2
		 * Поле допустимо не только для указанных выше стран (Sweden, Norway and Finland),
		 * но и для других (проверил для Австрии).
		 */
		,'street_address' => $this->test('street_address')
		/**
		 * 2017-01-28
		 * «Only in Germany and Austria: Street name.»
		 * Required: no.
		 * Type: string.
		 *
		 * Замечание №1
		 * Спецификация помечает это поле как «read only»,
		 * но на практике я установил, что веб-сервис его допускает.
		 *
		 * Замечание №2
		 * Поле допустимо не только для указанных выше стран (Germany and Austria),
		 * но и для других (проверил для Швеции).
		 *
		 * 2017-01-30
		 * [Klarna][Checkout v2] How are the «shipping_address.street_name»
		 * and «shipping_address.street_number» fields shown on the payment form?
		 * https://mage2.pro/t/2562
		 *
		 * [Klarna][Checkout v2] The documentation states that
		 * the «shipping_address.street_name» and «shipping_address.street_number» fields
		 * are read only, but really the API allows to pass them.
		 * https://mage2.pro/t/2563
		 */
		,'street_name' => $this->test('street_name')
		/**
		 * 2017-01-28
		 * «Only in Germany and Austria: Street number.»
		 * Required: no.
		 * Type: string.
		 *
		 * Замечание №1
		 * Спецификация помечает это поле как «read only»,
		 * но на практике я установил, что веб-сервис его допускает.
		 *
		 * Замечание №2
		 * Поле допустимо не только для указанных выше стран (Germany and Austria),
		 * но и для других (проверил для Швеции).
		 *
		 * 2017-01-30
		 * Замечание №1
		 * Это поле означает «номер дома».
		 * Платёжная форма для Германии и Австрии требует заполнения улицы и номера дома,
		 * причём в отдельных (обязательных) полях.
		 *
		 * Замечание №2
		 * Передача числа вместо строки приведёт к сбою «Bad format».
		 *
		 * [Klarna][Checkout v2] How are the «shipping_address.street_name»
		 * and «shipping_address.street_number» fields shown on the payment form?
		 * https://mage2.pro/t/2562
		 *
		 * [Klarna][Checkout v2] The documentation states that
		 * the «shipping_address.street_name» and «shipping_address.street_number» fields
		 * are read only, but really the API allows to pass them.
		 * https://mage2.pro/t/2563
		 */
		,'street_number' => strval($this->test('street_number'))
		/**
		 * 2017-01-28
		 * «Only in Germany and Austria:
		 * The customer's title, possible values are "Herr" and "Frau".»
		 * Required: no.
		 * Type: string.
		 * Спецификация помечает это поле как «read only»,
		 * но на практике я установил, что веб-сервис его допускает.
		 *
		 * 2017-01-30
		 * [Klarna][Checkout v2] How is the «shipping_address.title» field shown on the payment form?
		 * https://mage2.pro/t/2560
		 *
		 * [Klarna][Checkout v2] The documentation states that the «shipping_address.title» field
		 * is read only, but really the API allows to pass it in:
		 * https://mage2.pro/t/2561
		 * https://mail.google.com/mail/u/0/#sent/159ef3c974441d58
		 */
		,'title' => 'Herr'
	];}

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
	 * @used-by \Dfe\Klarna\Api\Checkout\V2\Charge\ShippingAddress::p()
	 * @return string
	 */
	private function test(string $key) {return df_nts(dfa(self::$test[$this->owner()->bCountry()], $key));}

	/**
	 * 2017-01-30 «[Klarna] Test addresses» https://mage2.pro/t/2555
	 * @used-by self::test()
	 * @var array(string => array(string => string|int))
	 */
	private static $test = [
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