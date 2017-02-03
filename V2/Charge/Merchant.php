<?php
// 2017-02-04
namespace Dfe\Klarna\V2\Charge;
final class Merchant {
	/**
	 * 2017-01-26
	 * «Merchant related information.»
	 * Required: yes.
	 * Type: merchant object.
	 * https://developers.klarna.com/en/se/kco-v2/checkout-api#merchant-object-properties
	 * @used-by \Dfe\Klarna\V2\Charge::kl_order()
	 * @return array(string => string)
	 */
	public function p() {return [
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
}