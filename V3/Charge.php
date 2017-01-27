<?php
// 2017-01-26
namespace Dfe\Klarna\V3;
final class Charge {
	/**
	 * 2017-01-23
	 * @used-by kl_options()
	 * @return array(string => string|bool)
	 */
	private function kl_additional_checkbox() {return [
		/**
		 * 2017-01-23
		 * «Default state of the additional checkbox.
		 * It will use this value when loaded for the first time.»
		 * Required: yes.
		 * boolean
		 * https://developers.klarna.com/api/?json#checkout-api__orderoptionsadditional_checkbox__checked
		 */
		'checked' => ''
		/**
		 * 2017-01-23
		 * «Whether it is required for the consumer
		 * to check the additional checkbox box or not in order to complete the purchase.»
		 * Required: yes.
		 * boolean
		 * https://developers.klarna.com/api/?json#checkout-api__orderoptionsadditional_checkbox__required
		 */
		,'required' => ''
		/**
		 * 2017-01-23
		 * «Text that will be displayed to the consumer aside the checkbox. (max 255 characters)»
		 * Required: yes.
		 * string
		 * https://developers.klarna.com/api/?json#checkout-api__orderoptionsadditional_checkbox__text
		 */
		,'text' => ''
	];}

	/**
	 * 2017-01-23
	 * «Additional purchase information required for some industries.»
	 * https://developers.klarna.com/api/?json#checkout-api__order__attachment
	 * @used-by kl_order()
	 * @return array(string => string)
	 */
	private function kl_attachment() {return [
		/**
		 * 2017-01-23
		 * «This field should be a string containing the body of the attachment.
		 * The body should be an object containing any of the keys and sub objects
		 * described below serialised to JSON.»
		 * Required: yes.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__orderattachment__body
		 */
		'body' => ''
		/**
		 * 2017-01-23
		 * «The content type of the body property.»
		 * Required: yes.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__orderattachment__content_type
		 */
		,'content_type' => ''
	];}

	/**
	 * 2017-01-23
	 * https://developers.klarna.com/api/?json#checkout-api__order__billing_address
	 * @used-by kl_order()
	 * @return array(string => string)
	 */
	private function kl_billing_address() {return [
		/**
		 * 2017-01-23
		 * «City»
		 * Required: no.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__ordershipping_address__city
		 */
		'city' => ''
		/**
		 * 2017-01-23
		 * «ISO 3166 alpha-2. Country.»
		 * Required: no.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__ordershipping_address__country
		 */
		,'country' => ''
		/**
		 * 2017-01-23
		 * «E-mail address»
		 * Required: no.
		 * Type: string
		 * https://developers.klarna.com/api/?json#checkout-api__ordershipping_address__email
		 */
		,'email' => 'admin@mage2.pro'
		/**
		 * 2017-01-23
		 * «Family name»
		 * Required: no.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__ordershipping_address__family_name
		 */
		,'family_name' => 'Fedyuk'
		/**
		 * 2017-01-23
		 * «Given name»
		 * Required: no.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__ordershipping_address__given_name
		 */
		,'given_name' => 'Dmitry'
		/**
		 * 2017-01-23
		 * «Phone number»
		 * Required: no.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__ordershipping_address__phone
		 */
		,'phone' => ''
		/**
		 * 2017-01-23
		 * «Postal/post code.»
		 * Required: no.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__ordershipping_address__postal_code
		 */
		,'postal_code' => ''
		/**
		 * 2017-01-23
		 * «Street address, first line.»
		 * Required: no.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__ordershipping_address__street_address
		 */
		,'street_address' => ''
		/**
		 * 2017-01-23
		 * «Street address, second line.»
		 * Required: no.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__ordershipping_address__street_address2
		 */
		,'street_address2' => ''
		/**
		 * 2017-01-23
		 * «Title.
		 * Valid values for UK: Mr, Ms, Mrs, Miss.
		 * Valid values for DACH: Herr, Frau.»
		 * DACH: https://de.wikipedia.org/wiki/D-A-CH
		 * Required: no.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__ordershipping_address__title
		 */
		,'title' => ''
		/**
		 * 2017-01-23
		 * «State or Region»
		 * Required: no.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__ordershipping_address__region
		 */
		,'region' => ''
	];}

	/**
	 * 2017-01-23
	 * «Information about the liable customer of the order.»
	 * https://developers.klarna.com/api/?json#checkout-api__order__customer
	 * @used-by kl_order()
	 * @return array(string => string)
	 */
	private function kl_customer() {return [
		/**
		 * 2017-01-23
		 * «ISO 8601 date. The customer date of birth.»
		 * https://developers.klarna.com/api/?json#checkout-api__ordercustomer__date_of_birth
		 * https://developers.klarna.com/api/?json#data-types
		 * В документации формат даты в примерах именно такой.
		 * Required: no.
		 * Type: string.
		 */
		'date_of_birth' => '1982-07-08'
	];}

	/**
	 * 2017-01-23
	 * «The merchant_urls object.»
	 * https://developers.klarna.com/api/?json#checkout-api__order__merchant_urls
	 * @used-by kl_order()
	 * @return array(string => string)
	 */
	private function kl_merchant_urls() {return [
		/**
		 * 2017-01-23
		 * «URL for shipping, tax and purchase currency updates.
		 * Will be called on address changes.
		 * (must be https, max 2000 characters)»
		 * Required: no.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__ordermerchant_urls__address_update
		 */
		'address_update' => ''
		/**
		 * 2017-01-23
		 * «URL of merchant checkout page.
		 * Should be different than terms, confirmation and push URLs.
		 * (max 2000 characters)»
		 * Required: yes.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__ordermerchant_urls__checkout
		 */
		,'checkout' => ''
		/**
		 * 2017-01-23
		 * «URL of merchant confirmation page.
		 * Should be different than checkout and confirmation URLs.
		 * (max 2000 characters)»
		 * Required: yes.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__ordermerchant_urls__confirmation
		 */
		,'confirmation' => ''
		/**
		 * 2017-01-23
		 * «URL for shipping, tax and purchase currency updates.
		 * Will be called on purchase country changes.
		 * (must be https, max 2000 characters)»
		 * Required: no.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__ordermerchant_urls__country_change
		 */
		,'country_change' => ''
		/**
		 * 2017-01-23
		 * «URL for notifications on pending orders. (max 2000 characters)»
		 * Required: no.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__ordermerchant_urls__notification
		 */
		,'notification' => ''
		/**
		 * 2017-01-23
		 * «URL that will be requested when an order is completed.
		 * Should be different than checkout and confirmation URLs.
		 * (max 2000 characters)»
		 * Required: yes.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__ordermerchant_urls__push
		 */
		,'push' => ''
		/**
		 * 2017-01-23
		 * «URL for shipping option update.
		 * (must be https, max 2000 characters)»
		 * Required: no.
		 * Type: string.
		 * URL for shipping option update. (must be https, max 2000 characters)
		 */
		,'shipping_option_update' => ''
		/**
		 * 2017-01-23
		 * «URL of merchant terms and conditions.
		 * Should be different than checkout, confirmation and push URLs.
		 * (max 2000 characters)»
		 * Required: yes.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__ordermerchant_urls__terms
		 */
		,'terms' => ''
		/**
		 * 2017-01-23
		 * «URL that will be requested for final merchant validation.
		 * (must be https, max 2000 characters)»
		 * Required: no.
		 * Type: string.
		 */
		,'validation' => ''
	];}

	/**
	 * 2017-01-23
	 * «Options for this purchase.»
	 * https://developers.klarna.com/api/?json#checkout-api__order__options
	 * @used-by kl_order()
	 * @return array(string => string|boolean)
	 */
	private function kl_options() {return [
		/**
		 * 2017-01-23
		 * «Additional merchant defined checkbox. e.g. for Newsletter opt-in.»
		 * Required: yes.
		 * Type: object.
		 */
		'additional_checkbox' => $this->kl_additional_checkbox()
		/**
		 * 2017-01-23
		 * «If true, Checkout will allow the consumer to use any billing country supported,
		 * otherwise the selection will be limited to the countries provided in shipping_countries field.
		 * Default: false.»
		 * Required: no.
		 * Type: boolean.
		 * https://developers.klarna.com/api/?json#checkout-api__orderoptions__allow_global_billing_countries
		 */
		,'allow_global_billing_countries' => false
		/**
		 * 2017-01-23
		 * «If true, the consumer can enter different billing and shipping addresses.
		 * Default: false»
		 * Required: no.
		 * Type: boolean.
		 * https://developers.klarna.com/api/?json#checkout-api__orderoptions__allow_separate_shipping_address
		 */
		,'allow_separate_shipping_address' => false
		/**
		 * 2017-01-23
		 * «CSS hex color, e.g. "#FF9900"»
		 * Required: no.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__orderoptions__color_button
		 */
		,'color_button' => ''
		/**
		 * 2017-01-23
		 * «CSS hex color, e.g. "#FF9900"»
		 * Required: no.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__orderoptions__color_button_text
		 */
		,'color_button_text' => ''
		/**
		 * 2017-01-23
		 * «CSS hex color, e.g. "#FF9900"»
		 * Required: no.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__orderoptions__color_checkbox
		 */
		,'color_checkbox' => ''
		/**
		 * 2017-01-23
		 * «CSS hex color, e.g. "#FF9900"»
		 * Required: no.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__orderoptions__color_checkbox_checkmark
		 */
		,'color_checkbox_checkmark' => ''
		/**
		 * 2017-01-23
		 * «CSS hex color, e.g. "#FF9900"»
		 * Required: no.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__orderoptions__color_header
		 */
		,'color_header' => ''
		/**
		 * 2017-01-23
		 * «CSS hex color, e.g. "#FF9900"»
		 * Required: no.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__orderoptions__color_link
		 */
		,'color_link' => ''
		/**
		 * 2017-01-23
		 * «If true, the consumer cannot skip date of birth.
		 * Default: false»
		 * Required: no.
		 * Type: boolean.
		 * https://developers.klarna.com/api/?json#checkout-api__orderoptions__date_of_birth_mandatory
		 */
		,'date_of_birth_mandatory' => false
		/**
		 * 2017-01-23
		 * «Border radius»
		 * Required: no.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__orderoptions__radius_border
		 */
		,'radius_border' => ''
		/**
		 * 2017-01-23
		 * «If true, validate callback must get a positive response to not stop purchase.
		 * Default: false.»
		 * Required: no.
		 * Type: boolean.
		 * https://developers.klarna.com/api/?json#checkout-api__orderoptions__require_validate_callback_success
		 */
		,'require_validate_callback_success' => false
		/**
		 * 2017-01-23
		 * «A message that will be presented on the confirmation page under the headline "Delivery".»
		 * Required: no.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__orderoptions__shipping_details
		 */
		,'shipping_details' => ''
		/**
		 * 2017-01-23
		 * «If true, the Order Detail subtodals view is expanded.
		 * Default: false»
		 * Required: no.
		 * Type: boolean.
		 * https://developers.klarna.com/api/?json#checkout-api__orderoptions__show_subtotal_detail
		 */
		,'show_subtotal_detail' => false
		/**
		 * 2017-01-23
		 * «If specified to false, title becomes optional in countries that by default require title.»
		 * Required: no.
		 * Type: boolean.
		 * https://developers.klarna.com/api/?json#checkout-api__orderoptions__title_mandatory
		 */
		,'title_mandatory' => true
	];}

	/**
	 * 2017-01-22
	 * https://developers.klarna.com/api/?json#checkout-api-order
	 * https://developers.klarna.com/en/us/kco-v3/checkout/2-render-the-checkout#add-cart-items
	 * @used-by p()
	 * @return array(string => mixed)
	 */
	private function kl_order() {return [
		/**
		 * 2017-01-23
		 * «Additional purchase information required for some industries.»
		 * Required: no.
		 * Type: object.
		 * https://developers.klarna.com/api/?json#checkout-api__order__attachment
		 */
		'attachment' => $this->kl_attachment()
		/**
		 * 2017-01-22
		 * «Once the customer has provided any data in the checkout iframe,
		 * updates to this object will be ignored (without generating an error).»
		 * Required: no.
		 * Type: object.
		 * https://developers.klarna.com/api/?json#checkout-api__order__billing_address
		 */
		,'billing_address' => $this->kl_billing_address()
		/**
		 * 2017-01-23
		 * «Information about the liable customer of the order.»
		 * Required: no.
		 * Type: object.
		 * https://developers.klarna.com/api/?json#checkout-api__order__customer
		 */
		,'customer' => $this->kl_customer()
		/**
		 * 2017-01-23
		 * «List of external checkouts.»
		 * Required: no.
		 * Type: array of payment providers.
		 * https://developers.klarna.com/api/?json#checkout-api__order__external_checkouts
		 */
		,'external_checkouts' => []
		/**
		 * 2017-01-23
		 * «List of external payment methods.»
		 * Required: no.
		 * Type: array of payment providers.
		 * https://developers.klarna.com/api/?json#checkout-api__order__external_payment_methods
		 */
		,'external_payment_methods' => []
		/**
		 * 2017-01-23
		 * «The gui object.»
		 * Required: no.
		 * Type: object.
		 * https://developers.klarna.com/api/?json#checkout-api__order__gui
		 */
		,'gui' => []
		/**
		 * 2017-01-22
		 * «RFC 1766 customer's locale.»
		 * Required: yes.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__order__locale
		 */
		,'locale' => 'en-US'
		/**
		 * 2017-01-23
		 * «Pass through field (max 1024 characters).»
		 * Required: no.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__order__merchant_data
		 */
		,'merchant_data' => ''
		/**
		 * 2017-01-23
		 * «Used for storing merchant's internal order number or other reference.
		 * If set, will be shown on the confirmation page as "order number"
		 * (max 255 characters).»
		 * Required: no.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__order__merchant_reference1
		 */
		,'merchant_reference1' => ''
		/**
		 * 2017-01-23
		 * «Used for storing merchant's internal order number or other reference
		 * (max 255 characters).»
		 * Required: no.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__order__merchant_reference2
		 */
		,'merchant_reference2' => ''
		/**
		 * 2017-01-23
		 * «The merchant_urls object.»
		 * Required: yes.
		 * Type: object.
		 * https://developers.klarna.com/api/?json#checkout-api__order__merchant_urls
		 */
		,'merchant_urls' => $this->kl_merchant_urls()
		/**
		 * 2017-01-23
		 * «Options for this purchase.»
		 * Required: no.
		 * Type: object.
		 * https://developers.klarna.com/api/?json#checkout-api__order__options
		 */
		,'options' => $this->kl_options()
		/**
		 * 2017-01-23
		 * «Non-negative, minor units.
		 * Total amount of the order, including tax and any discounts.»
		 * Required: yes.
		 * Type: integer.
		 * https://developers.klarna.com/api/?json#checkout-api__order__order_amount
		 */
		,'order_amount' => 1000
		/**
		 * 2017-01-22
		 * «The applicable order lines (max 1000).»
		 * Required: yes.
		 * Type: array.
		 * https://developers.klarna.com/api/#checkout-api__order__order_lines
		 */
		,'order_lines' => $this->kl_order_lines()
		/**
		 * 2017-01-23
		 * «Non-negative, minor units.
		 * The total tax amount of the order.»
		 * Required: yes.
		 * Type: integer.
		 * https://developers.klarna.com/api/?json#checkout-api__order__order_tax_amount
		 */
		,'order_tax_amount' => 0
		/**
		 * 2017-01-22
		 * «ISO 3166 alpha-2 purchase country.»
		 * Required: yes.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__order__purchase_country
		 */
		,'purchase_country' => 'US'
		/**
		 * 2017-01-22
		 * «ISO 4217 purchase currency.»
		 * Required: yes.
		 * Type: string.
		 * https://developers.klarna.com/api/?json#checkout-api__order__purchase_currency
		 */
		,'purchase_currency' => 'USD'
		/**
		 * 2017-01-23
		 * «A list of countries (ISO 3166 alpha-2).
		 * Default is purchase_country only.»
		 * Required: no.
		 * Type: array of strings.
		 * https://developers.klarna.com/api/?json#checkout-api__order__shipping_countries
		 */
		,'shipping_countries' => []
		/**
		 * 2017-01-23
		 * «A list of shipping options available for this order.»
		 * Required: no.
		 * Type: array of shipping options.
		 * https://developers.klarna.com/api/?json#checkout-api__order__shipping_options
		 */
		,'shipping_options' => []
	];}

	/**
	 * 2017-01-22
	 * https://developers.klarna.com/api/#checkout-api__order__order_lines
	 * @used-by kl_order()
	 * @return array(string => string|int)
	 */
	private function kl_order_lines() {return [[
		/**
		 * 2017-01-22
		 * «URL to an image that can be later embedded in communications
		 * between Klarna and the customer. (max 1024 characters).»
		 * Required: no.
		 * Type: string.
		 * https://developers.klarna.com/api/#checkout-api__order__order_lines__image_url
		 */
		'image_url' => ''
		/**
		 * 2017-01-22
		 * «Pass through field. (max 255 characters)»
		 * Required: no.
		 * Type: string.
		 * https://developers.klarna.com/api/#checkout-api__order__order_lines__merchant_data
		 */
		,'merchant_data' => ''
		/**
		 * 2017-01-22
		 * «Descriptive item name.»
		 * Required: yes.
		 * Type: string.
		 * https://developers.klarna.com/api/#checkout-api__order__order_lines__name
		 */
		,'name' => 'Tomatoes'
		/**
		 * 2017-01-22
		 * «URL to the product page that can be later embedded in communications
		 * between Klarna and the customer. (max 1024 characters).»
		 * Required: no.
		 * Type: string.
		 * https://developers.klarna.com/api/#checkout-api__order__order_lines__product_url
		 */
		,'product_url' => ''
		/**
		 * 2017-01-22
		 * «Non-negative. The item quantity.»
		 * Required: yes.
		 * Type: integer.
		 * https://developers.klarna.com/api/#checkout-api__order__order_lines__quantity
		 */
		,'quantity' => 10
		/**
		 * 2017-01-22
		 * «Unit used to describe the quantity, e.g. kg, pcs...
		 * If defined has to be 1-8 characters.»
		 * Required: no.
		 * Type: string.
		 * https://developers.klarna.com/api/#checkout-api__order__order_lines__quantity_unit
		 */
		,'quantity_unit' => 'kg'
		/**
		 * 2017-01-22
		 * «Article number, SKU or similar.»
		 * Required: no.
		 * Type: string.
		 * https://developers.klarna.com/api/#checkout-api__order__order_lines__reference
		 */
		,'reference' => '123050'
		/**
		 * 2017-01-22
		 * «Order line type. Possible values: digital, discount, gift_card, physical,
		 * sales_tax, shipping_fee, store_credit, surcharge.»
		 * Required: no.
		 * Type: string.
		 * https://developers.klarna.com/api/#checkout-api__order__order_lines__type
		 */
		,'type' => 'physical'
		/**
		 * 2017-01-22
		 * «Non-negative. In percent, two implicit decimals. I.e 2500 = 25%.»
		 * Required: yes.
		 * Type: integer.
		 * https://developers.klarna.com/api/#checkout-api__order__order_lines__tax_rate
		 */
		,'tax_rate' => 2500
		/**
		 * 2017-01-22
		 * «Includes tax and discount.
		 * Must match (quantity unit_price) - total_discount_amount within ±quantity.
		 * (max value: 100000000)»
		 * Required: true.
		 * Type: integer.
		 * https://developers.klarna.com/api/#checkout-api__order__order_lines__total_amount
		 */
		,'total_amount' => 6000
		/**
		 * 2017-01-22
		 * «Non-negative minor units. Includes tax.»
		 * Required: no.
		 * Type: integer.
		 * https://developers.klarna.com/api/#checkout-api__order__order_lines__total_discount_amount
		 */
		,'total_discount_amount' => 0
		/**
		 * 2017-01-22
		 * «Must be within ±1 of total_amount - total_amount 10000 / (10000 + tax_rate).
		 * Negative when type is discount.»
		 * Required: true.
		 * Type: integer.
		 * https://developers.klarna.com/api/#checkout-api__order__order_lines__total_tax_amount
		 */
		,'total_tax_amount' => 1200
		/**
		 * 2017-01-22
		 * «Minor units. Includes tax, excludes discount. (max value: 100000000)»
		 * Required: yes.
		 * Type: integer.
		 * https://developers.klarna.com/api/#checkout-api__order__order_lines__unit_price
		 */
		,'unit_price' => 600
	]];}

	/**
	 * 2017-01-26
	 * @return array(string => mixed)
	 */
	public static function p() {return (new self)->kl_order();}
}