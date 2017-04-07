<?php
// 2017-02-04
namespace Dfe\Klarna\Api\Checkout\V2\Charge;
final class Attachment {
	/**
	 * 2017-01-26
	 * «Additional purchase information required for some industries.»
	 * Required: no.
	 * Type: attachment object.
	 * https://developers.klarna.com/en/se/kco-v2/checkout-api#attachment-object-properties
	 * @used-by \Dfe\Klarna\Api\Checkout\V2\Charge::kl_order()
	 * @return array(string => string)
	 *
	 * 2017-01-28
	 * A list of available attachment types:
	 * https://developers.klarna.com/en/se/kco-v2/checkout-api/attachments
	 */
	function p() {return [
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
}