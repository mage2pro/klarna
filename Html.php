<?php
namespace Dfe\Klarna;
use Magento\Quote\Api\Data\AddressInterface as IQA;
use Magento\Quote\Api\Data\PaymentInterface as IQP;
use Magento\Quote\Model\Quote\Address as QA;
use Magento\Quote\Model\Quote\Payment as QP;
// 2017-04-04
final class Html {
	/**
	 * 2017-04-04 Для анонимных покупателей $cartId — это строка вида «63b25f081bfb8e4594725d8a58b012f7».
	 * 2017-04-20
	 * $qp в поле @see \Magento\Framework\DataObject::_data содержит код способа оплаты,
	 * а также ту дополнительную информацию, которую передала клиентская часть модуля оплаты.
	 * Например: [additional_data => [], method => "dfe_klarna"].
	 * @param string $cartId
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
	 * 2017-04-20
	 * $qp в поле @see \Magento\Framework\DataObject::_data содержит код способа оплаты,
	 * а также ту дополнительную информацию, которую передала клиентская часть модуля оплаты.
	 * Например: [additional_data => [], method => "dfe_klarna"].
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