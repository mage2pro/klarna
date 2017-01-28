<?php
// 2017-01-26
namespace Dfe\Klarna\V2;
class Charge {
	/**
	 * 2017-01-26
	 * «Additional purchase information required for some industries.»
	 * Required: no.
	 * Type: attachment object.
	 * https://developers.klarna.com/en/se/kco-v2/checkout-api#attachment-object-properties
	 * @used-by kl_order()
	 * @return array(string => string)
	 */
	private function kl_attachment() {return [
		/**
		 * 2017-01-26
		 * «The attachment body.»
		 * Required: yes.
		 * Type: string.
		 */
		'body' => ''
		/**
		 * 2017-01-26
		 * «The content type of the body property.»
		 * Required: yes.
		 * Type: string.
		 */
		,'content_type' => ''
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
	private function kl_merchant_urls() {return [
		/**
		 * 2017-01-26
		 * «URI of your store page. Used on the settlement page.»
		 * Required: no.
		 * Type: string.
		 */
		'back_to_store_uri' => ''
		/**
		 * 2017-01-26
		 * «URI of the cancellation terms»
		 * Required: no.
		 * Type: string.
		 */
		,'cancellation_terms_uri' => ''
		/**
		 * 2017-01-26
		 * «URI of your checkout page»
		 * Required: yes.
		 * Type: string.
		 */
		,'checkout_uri' => ''
		/**
		 * 2017-01-26
		 * «URI of your confirmation page»
		 * Required: yes.
		 * Type: string.
		 */
		,'confirmation_uri' => ''
		/**
		 * 2017-01-26
		 * «URI of your terms and conditions for B2B purchases/organizations
		 * (may be used in the B2B flow).»
		 * Required: no.
		 * Type: string.
		 */
		,'organization_terms_uri' => ''
		/**
		 * 2017-01-26
		 * «URI of your push-notification page»
		 * Required: yes.
		 * Type: string.
		 */
		,'push_uri' => ''
		/**
		 * 2017-01-26
		 * «URI of your terms and conditions»
		 * Required: yes.
		 * Type: string.
		 */
		,'terms_uri' => ''
		/**
		 * 2017-01-26
		 * «URI of your validation page, see validate a checkout order.»
		 * https://developers.klarna.com/en/se/kco-v2/checkout/use-cases#validate-checkout-order
		 * Required: no.
		 * Type: string.
		 */
		,'validation_uri' => ''
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
		,'color_button' => '#FF9900'
		/**
		 * 2017-01-27
		 * «Only hexadecimal values are allowed.»
		 * Required: no.
		 * Type: string.
		 * При указании пустой строки будет сбой: «Bad format».
		 */
		,'color_button_text' => '#FF9900'
		/**
		 * 2017-01-27
		 * «Only hexadecimal values are allowed.»
		 * Required: no.
		 * Type: string.
		 * При указании пустой строки будет сбой: «Bad format».
		 */
		,'color_checkbox' => '#FF9900'
		/**
		 * 2017-01-27
		 * «Only hexadecimal values are allowed.»
		 * Required: no.
		 * Type: string.
		 * При указании пустой строки будет сбой: «Bad format».
		 */
		,'color_checkbox_checkmark' => '#FF9900'
		/**
		 * 2017-01-27
		 * «Only hexadecimal values are allowed.»
		 * Required: no.
		 * Type: string.
		 * При указании пустой строки будет сбой: «Bad format».
		 */
		,'color_header' => '#FF9900'
		/**
		 * 2017-01-27
		 * «Only hexadecimal values are allowed.»
		 * Required: no.
		 * Type: string.
		 * При указании пустой строки будет сбой: «Bad format».
		 */
		,'color_link' => '#FF9900'
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
		 */
		'attachment' => $this->kl_attachment()
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
		 */
		,'locale' => ''
		/**
		 * 2017-01-26
		 * «Merchant related information.»
		 * Required: yes.
		 * Type: merchant object.
		 * https://developers.klarna.com/en/se/kco-v2/checkout-api#merchant-object-properties
		 */
		,'merchant' => $this->kl_merchant_urls()
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
	 * @used-by kl_order()
	 * @return array(string => string|int)
	 */
	private function kl_order_lines() {return [[
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
		 */
		,'ean' => ''
		/**
		 * 2017-01-26
		 * «Item image URI.
		 * Please note this property is currently not returned when fetching the full order resource.»
		 * Required: no.
		 * Type: string.
		 */
		,'image_uri' => ''
		/**
		 * 2017-01-26
		 * «Name, usually a short description»
		 * Required: yes.
		 * Type: string.
		 */
		,'name' => ''
		/**
		 * 2017-01-26
		 * «Quantity»
		 * Required: yes.
		 * Type: integer.
		 */
		,'quantity' => 1
		/**
		 * 2017-01-26
		 * «Reference, usually the article number»
		 * Required: yes.
		 * Type: string.
		 */
		,'reference' => ''
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
		 */
		,'type' => 'physical'
		/**
		 * 2017-01-26
		 * «Unit price in cents, including tax»
		 * Required: yes.
		 * Type: integer.
		 */
		,'unit_price' => 1
		/**
		 * 2017-01-26
		 * «Item product page URI.
		 * Please note this property is currently not returned when fetching the full order resource.»
		 * Required: no.
		 * Type: string.
		 */
		,'uri' => ''
	]];}

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
		 * «First name»
		 * Required: no.
		 * Type: string.
		 * Спецификация помечает это поле как «read only»,
		 * но на практике я установил, что веб-сервис его допускает.
		 */
		'given_name' => 'Dmitry'
	];}

	/**
	 * 2017-01-26
	 * @return array(string => mixed)
	 */
	public static function p() {return (new self)->kl_order();}
}