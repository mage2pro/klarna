<?php
namespace Dfe\Klarna;
use Dfe\Klarna\Api\Checkout as API;
use Magento\Quote\Api\Data\AddressInterface as IQA;
use Magento\Quote\Api\Data\PaymentInterface as IQP;
use Magento\Quote\Model\Quote\Address as QA;
use Magento\Quote\Model\Quote\Payment as QP;
# 2017-04-04
final class Html {
	/**
	 * 2017-04-04 $cartId is a string like «63b25f081bfb8e4594725d8a58b012f7» for guests.
	 * 2017-04-20
	 * $qp в поле @see \Magento\Framework\DataObject::_data содержит код способа оплаты,
	 * а также ту дополнительную информацию, которую передала клиентская часть модуля оплаты.
	 * Например: [additional_data => [], method => "dfe_klarna"].
	 * @param IQP|QP $qp
	 * @param IQA|QA|null $ba
	 * 2017-04-05 Важно возвращать именно string: @see dfw_encode()
	 */
	function guest(string $cartId, string $email, IQP $qp, IQA $ba = null):string {return dfw_encode([
		'html' => API::html(null, 'SE'
	)]);}

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
	function registered($cartId, IQP $qp, IQA $ba = null) {return dfw_encode([
		'html' => API::html(null, 'SE')
	]);}
}