<?php
# 2017-02-04
namespace Dfe\Klarna\Api\Checkout\V2\Charge;
final class Customer extends Part {
	/**
	 * 2017-01-26
	 * «Information about the liable customer of the order.»
	 * Required: no.
	 * Type: customer object.
	 * https://developers.klarna.com/en/se/kco-v2/checkout-api#customer-object-properties
	 * @used-by \Dfe\Klarna\Api\Checkout\V2\Charge::kl_order()
	 * @return array(string => string)
	 */
	function p() {return [
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
}