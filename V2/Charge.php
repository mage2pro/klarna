<?php
// 2017-01-26
namespace Dfe\Klarna\V2;
use Dfe\Klarna\T\Data as Test;
use Magento\Sales\Model\Order\Item as OI;
final class Charge {
	/**
	 * 2017-01-29
	 * @used-by p()
	 * @param string $buyerCountry
	 */
	private function __construct($buyerCountry) {$this->_buyerCountry = $buyerCountry;}

	/**
	 * 2017-01-26
	 * «Additional purchase information required for some industries.»
	 * Required: no.
	 * Type: attachment object.
	 * https://developers.klarna.com/en/se/kco-v2/checkout-api#attachment-object-properties
	 * @used-by kl_order()
	 * @return array(string => string)
	 *
	 * 2017-01-28
	 * A list of available attachment types:
	 * https://developers.klarna.com/en/se/kco-v2/checkout-api/attachments
	 */
	private function kl_attachment() {return [
		/**
		 * 2017-01-26
		 * «The attachment body.»
		 * Required: yes.
		 * Type: string.
		 *
		 * 2017-01-28
		 * Замечание №1
		 * Пустое значение приводит к сбою «Bad format».
		 *
		 * Замечание №2
		 * «Body: A JSON string serialized from the resource described below.»
		 * https://developers.klarna.com/en/se/kco-v2/checkout-api/attachments#emd-object-properties
		 */
		'body' => '{}'
		/**
		 * 2017-01-26
		 * «The content type of the body property.»
		 * Required: yes.
		 * Type: string.
		 * https://developers.klarna.com/en/se/kco-v2/checkout-api/attachments#emd-object-properties
		 *
		 * 2017-01-28
		 * Пустое значение приводит к сбою «Bad format».
		 */
		,'content_type' => 'application/vnd.klarna.internal.emd-v2+json'
	];}

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
	 * «Merchant related information.»
	 * Required: yes.
	 * Type: merchant object.
	 * https://developers.klarna.com/en/se/kco-v2/checkout-api#merchant-object-properties
	 * @used-by kl_order()
	 * @return array(string => string)
	 */
	private function kl_merchant() {return [
		/**
		 * 2017-01-28
		 * «Unique identifier (EID)»
		 * Required: yes.
		 * Type: string.
		 * Хотя значение является числом, его надо указывать как строку, иначе будет сбой «Bad format».
		 */
		'id' => '7765'
		/**
		 * 2017-01-26
		 * «URI of your store page. Used on the settlement page.»
		 * Required: no.
		 * Type: string.
		 *
		 * 2017-01-28
		 * Этому полю допустимо отсутствовать,
		 * но если оно присутствует, то его значение должно быть непусто, иначе будет сбой «Bad format».
		 */
		,'back_to_store_uri' => 'https://mage2.pro'
		/**
		 * 2017-01-26
		 * «URI of the cancellation terms»
		 * Required: no.
		 * Type: string.
		 *
		 * 2017-01-28
		 * Этому полю допустимо отсутствовать,
		 * но если оно присутствует, то его значение должно быть непусто, иначе будет сбой «Bad format».
		 */
		,'cancellation_terms_uri' => 'https://mage2.pro'
		/**
		 * 2017-01-26
		 * «URI of your checkout page»
		 * Required: yes.
		 * Type: string.
		 *
		 * 2017-01-28
		 * Пустое значение приводит к сбою «Bad format».
		 */
		,'checkout_uri' => 'https://mage2.pro'
		/**
		 * 2017-01-26
		 * «URI of your confirmation page»
		 * Required: yes.
		 * Type: string.
		 *
		 * 2017-01-28
		 * Пустое значение приводит к сбою «Bad format».
		 */
		,'confirmation_uri' => 'https://mage2.pro'
		/**
		 * 2017-01-26
		 * «URI of your terms and conditions for B2B purchases/organizations
		 * (may be used in the B2B flow).»
		 * Required: no.
		 * Type: string.
		 *
		 * 2017-01-28
		 * Этому полю допустимо отсутствовать,
		 * но если оно присутствует, то его значение должно быть непусто, иначе будет сбой «Bad format».
		 */
		,'organization_terms_uri' => 'https://mage2.pro'
		/**
		 * 2017-01-26
		 * «URI of your push-notification page»
		 * Required: yes.
		 * Type: string.
		 *
		 * 2017-01-28
		 * Пустое значение приводит к сбою «Bad format».
		 */
		,'push_uri' => 'https://mage2.pro'
		/**
		 * 2017-01-26
		 * «URI of your terms and conditions»
		 * Required: yes.
		 * Type: string.
		 *
		 * 2017-01-28
		 * Пустое значение приводит к сбою «Bad format».
		 */
		,'terms_uri' => 'https://mage2.pro'
		/**
		 * 2017-01-26
		 * «URI of your validation page, see validate a checkout order.»
		 * https://developers.klarna.com/en/se/kco-v2/checkout/use-cases#validate-checkout-order
		 * Required: no.
		 * Type: string.
		 * 
		 * 2017-01-28
		 * Этому полю допустимо отсутствовать,
		 * но если оно присутствует, то его значение должно быть непусто, иначе будет сбой «Bad format».
		 */
		,'validation_uri' => 'https://mage2.pro'
	];}

	/**
	 * 2017-01-27
	 * «Options for this purchase.»
	 * Required: no.
	 * Type: options object.
	 * https://developers.klarna.com/en/se/kco-v2/checkout/extra-features
	 * https://developers.klarna.com/en/se/kco-v2/checkout-api#options-object-properties
	 * @used-by kl_order()
	 * @return array(string => string|boolean)
	 */
	private function kl_options() {return [
		/**
		 * 2017-01-27
		 * «Additional merchant defined checkbox. e.g. for Newsletter opt-in.»
		 * Required: no.
		 * Type: checkbox object.
		 * https://developers.klarna.com/en/se/kco-v2/checkout-api#checkbox-object-properties
		 * Пустой массив в качестве значения указывать нельзя, иначе будет сбой «Bad format».
		 */
		'additional_checkbox' => [
			/**
			 * 2017-01-27
			 * «Default state of the additional checkbox.
			 * It will use this value when loaded for the first time.»
			 * Required: yes.
			 * Type: boolean.
			 */
			'checked' => true
			/**
			 * 2017-01-27
			 * «Whether it is required for the consumer to check the additional checkbox box
			 * or not in order to complete the purchase.»
			 * Required: yes.
			 * Type: boolean.
			 */
			,'required' => true
			/**
			 * 2017-01-27
			 * «Text that will be displayed to the consumer aside the checkbox. (max 255 characters).
			 * This text can contain links using the format [Link text](url).»
			 * Required: yes.
			 * Type: string.
			 */
			,'text' => 'I have already bought the [«Klarna» payment extension](https://mage2.pro/c/extensions/klarna).'
		]
		/**
		 * 2017-01-27
		 * «To allow separate shipping addresses.»
		 * Required: no.
		 * Type: string.
		 */
		,'allow_separate_shipping_address' => false
		/**
		 * 2017-01-27
		 * «List of the allowed customer types.
		 * Allowed values are 'person' and 'organization' if B2B is enabled on the e-store ID.»
		 * Required: no.
		 * Type: list of string.
		 *
		 * Спросил у техподдержки:
		 * «[Klarna] How to enable «B2B» for a Checkout v2 merchant account?»
		 * https://mage2.pro/t/2537
		 * https://mail.google.com/mail/u/0/#sent/159e1a394602442d
		 */
		,'allowed_customer_types' => ['person', 'organization']
		/**
		 * 2017-01-27
		 * «Only hexadecimal values are allowed.»
		 * Required: no.
		 * Type: string.
		 * При указании пустой строки будет сбой: «Bad format».
		 */
		//,'color_button' => '#FF9900'
		/**
		 * 2017-01-27
		 * «Only hexadecimal values are allowed.»
		 * Required: no.
		 * Type: string.
		 * При указании пустой строки будет сбой: «Bad format».
		 */
		//,'color_button_text' => '#FF9900'
		/**
		 * 2017-01-27
		 * «Only hexadecimal values are allowed.»
		 * Required: no.
		 * Type: string.
		 * При указании пустой строки будет сбой: «Bad format».
		 */
		//,'color_checkbox' => '#FF9900'
		/**
		 * 2017-01-27
		 * «Only hexadecimal values are allowed.»
		 * Required: no.
		 * Type: string.
		 * При указании пустой строки будет сбой: «Bad format».
		 */
		//,'color_checkbox_checkmark' => '#FF9900'
		/**
		 * 2017-01-27
		 * «Only hexadecimal values are allowed.»
		 * Required: no.
		 * Type: string.
		 * При указании пустой строки будет сбой: «Bad format».
		 */
		//,'color_header' => '#FF9900'
		/**
		 * 2017-01-27
		 * «Only hexadecimal values are allowed.»
		 * Required: no.
		 * Type: string.
		 * При указании пустой строки будет сбой: «Bad format».
		 */
		//,'color_link' => '#FF9900'
		/**
		 * 2017-01-27
		 * «Making the date of birth mandatory.»
		 * Required: no.
		 * Type: boolean.
		 */
		,'date_of_birth_mandatory' => false
		/**
		 * 2017-01-27
		 * «Enable packstation  (Only available in Germany).»
		 * Required: no.
		 * Type: boolean.
		 */
		,'packstation_enabled' => false
		/**
		 * 2017-01-27
		 * «Making the phone field mandatory (Only available in Germany and Austria).»
		 * Required: no.
		 * Type: boolean.
		 */
		,'phone_mandatory' => false
		/**
		 * 2017-01-27
		 * «Shipping information displayed on the confirmation page.
		 * Maximum 70 characters.»
		 * Required: no.
		 * Type: string.
		 */
		,'shipping_details' => ''
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
		'attachment' => $this->kl_attachment()
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
		,'locale' => self::formatLocaleCode(df_locale_by_country($this->_buyerCountry))
		/**
		 * 2017-01-26
		 * «Merchant related information.»
		 * Required: yes.
		 * Type: merchant object.
		 * https://developers.klarna.com/en/se/kco-v2/checkout-api#merchant-object-properties
		 */
		,'merchant' => $this->kl_merchant()
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
		,'options' => $this->kl_options()
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
		,'purchase_country' => $this->_buyerCountry
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
		,'purchase_currency' => df_currency_by_country_c($this->_buyerCountry)
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
		,'shipping_address' => $this->kl_shipping_address()
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
	private function kl_order_lines() {return array_merge(
		$this->olProducts(), df_clean([$this->olDiscount(), $this->olShipping()])
	);}

	/**
	 * 2017-01-26
	 * «The shipping address»
	 * Type: address object.
	 * https://developers.klarna.com/en/se/kco-v2/checkout-api#address-object-properties
	 * @used-by kl_order()
	 * @return array(string => mixed)
	 * Похоже, что при использовании Checkout API версии 2
	 * мы не можем передать адрес покупателя сервису,
	 * потому что «billing_address» полностью read-only,
	 * а у «shipping_address» все важные для нас поля read-only.
	 * @todo Надо всё-таки проверить, попытаться что-то передать (имя, фамилию...).
	 * В то же время, Checkout API версии 3 позвляет нам передавать сервису «billing_address»:
	 * https://developers.klarna.com/api/?json#checkout-api__order__billing_address
	 *
	 * 2017-01-28
	 * Передача пустого массива приводит к сбою «Bad format».
	 */
	private function kl_shipping_address() {return [
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
		,'country' => $this->_buyerCountry
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
	 * 2017-02-01
	 * @used-by kl_order_lines()
	 * @return array(string => string|int)
	 */
	private function olDiscount() {return [];}

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
	 * @used-by kl_order_lines()
	 * @return array(string => string|int)
	 */
	private function olProducts() {return df_oi_leafs(Test::order(), function(OI $i) {return [
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
		 * Используем @used intval(), потому что
		 * @uses \Magento\Sales\Model\Order\Item::getQtyOrdered() возвращает вещественное число,
		 * а не целое, а передача в Klarna вещественного числа приводит к сбою «Bad format».
		 */
		,'quantity' => intval($i->getQtyOrdered())
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
		,'unit_price' => (100 * df_oi_price($i, true))
		/**
		 * 2017-01-26
		 * «Item product page URI.
		 * Please note this property is currently not returned when fetching the full order resource.»
		 * Required: no.
		 * Type: string.
		 */
		,'uri' => df_oi_url($i)
	];});}

	/**
	 * 2017-02-01
	 * @used-by kl_order_lines()
	 * @return array(string => string|int)
	 */
	private function olShipping() {return [];}

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
	 * @used-by kl_shipping_address()
	 * @param string $key
	 * @return string
	 */
	private function test($key) {return df_nts(dfa(Test::$other[$this->_buyerCountry], $key));}

	/**
	 * 2017-01-29
	 * @used-by __construct()
	 * @used-by kl_order()
	 * @used-by kl_shipping_address()
	 * @var string
	 */
	private $_buyerCountry;

	/**
	 * 2017-01-26
	 * @param string $buyerCountry
	 * @return array(string => mixed)
	 */
	public static function p($buyerCountry) {return (new self($buyerCountry))->kl_order();}

	/**
	 * 2017-01-30
	 * «sv_SE» => «sv-se»
	 * @param string $l
	 * @return string
	 */
	private static function formatLocaleCode($l) {return str_replace('_', '-', strtolower($l));}
}