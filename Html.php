<?php
namespace Dfe\Klarna;
use Magento\Quote\Api\Data\AddressInterface as IAddress;
use Magento\Quote\Api\Data\PaymentInterface as IPayment;
// 2017-04-04
final class Html {
	/**
	 * 2017-04-04
	 * @param string $cartId
	 * Для анонимных покупателей $cartId — это строка вида «63b25f081bfb8e4594725d8a58b012f7»
	 * @param string $email
	 * @param IPayment $paymentMethod
	 * @param IAddress|null $billingAddress
	 * @return array(string => mixed)
	 */
	function guest($cartId, $email, IPayment $paymentMethod, IAddress $billingAddress = null) {
		df_break();
		return [];
	}

	/**
	 * 2017-04-04
	 * @param int $cartId
	 * @param IPayment $paymentMethod
	 * @param IAddress|null $billingAddress
	 * @return array(string => mixed)
	 */
	function registered($cartId, IPayment $paymentMethod, IAddress $billingAddress = null) {
		df_break();
		return [];
	}
}