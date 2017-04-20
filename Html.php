<?php
namespace Dfe\Klarna;
use Magento\Quote\Api\Data\AddressInterface as IQA;
use Magento\Quote\Api\Data\PaymentInterface as IQP;
use Magento\Quote\Model\Quote\Address as QA;
use Magento\Quote\Model\Quote\Payment as QP;
// 2017-04-04
final class Html {
	/**
	 * 2017-04-04
	 * @param string $cartId
	 * Для анонимных покупателей $cartId — это строка вида «63b25f081bfb8e4594725d8a58b012f7»
	 * @param string $email
	 * @param IQP|QP $qp
	 * @param IQA|QA|null $ba
	 * 2017-04-05 Важно возвращать именно string: @see dfw_encode()
	 * @return string
	 */
	function guest($cartId, $email, IQP $qp, IQA $ba = null) {
		df_break();
		return dfw_encode(['html' => 'PREVED, MEDVED!']);
	}

	/**
	 * 2017-04-04
	 * @param int $cartId
	 * @param IQP|QP $qp
	 * @param IQA|QA|null $ba
	 * 2017-04-05 Важно возвращать именно string: @see dfw_encode()
	 * @return string
	 */
	function registered($cartId, IQP $qp, IQA $ba = null) {
		df_break();
		return dfw_encode(['html' => 'PREVED, MEDVED!']);
	}
}