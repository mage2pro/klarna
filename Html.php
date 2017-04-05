<?php
namespace Dfe\Klarna;
use Magento\Quote\Api\Data\AddressInterface as IAddress;
use Magento\Quote\Api\Data\PaymentInterface as IQP;
use Magento\Quote\Model\Quote\Payment as QP;
// 2017-04-04
final class Html {
	/**
	 * 2017-04-04
	 * @param string $cartId
	 * Для анонимных покупателей $cartId — это строка вида «63b25f081bfb8e4594725d8a58b012f7»
	 * @param string $email
	 * @param IQP|QP $qp
	 * @param IAddress|null $billingAddress
	 * 2017-04-05 Важно возвращать именно string: @see dfw_encode()
	 * @return string
	 */
	function guest($cartId, $email, IQP $qp, IAddress $billingAddress = null) {
		df_break();
		return dfw_encode([]);
	}

	/**
	 * 2017-04-04
	 * @param int $cartId
	 * @param IQP|QP $qp
	 * @param IAddress|null $billingAddress
	 * 2017-04-05 Важно возвращать именно string: @see dfw_encode()
	 * @return string
	 */
	function registered($cartId, IQP $qp, IAddress $billingAddress = null) {
		df_break();
		return dfw_encode([]);
	}
}