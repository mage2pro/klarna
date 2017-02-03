<?php
// 2017-02-04
namespace Dfe\Klarna\V2\Charge;
final class Options {
	/**
	 * 2017-01-27
	 * «Options for this purchase.»
	 * Required: no.
	 * Type: options object.
	 * https://developers.klarna.com/en/se/kco-v2/checkout/extra-features
	 * https://developers.klarna.com/en/se/kco-v2/checkout-api#options-object-properties
	 * @used-by \Dfe\Klarna\V2\Charge::kl_order()
	 * @return array(string => string|boolean)
	 */
	public function p() {return [
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
			,'text' => 'An example of [terms and conditions](https://mage2.pro/c/extensions/klarna).'
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
}