<?php
// 2016-12-17
namespace Dfe\Klarna;
use Magento\Sales\Model\Order as O;
use Magento\Sales\Model\Order\Address as OrderAddress;
use Magento\Sales\Model\Order\Payment as OP;
class Method extends \Df\Payment\R\Method {
	/**
	 * 2016-12-17
	 * Первый параметр — для test, второй — для live.
	 * @override
	 * @see \Df\Payment\R\Method::stageNames()
	 * @used-by \Df\Payment\R\Method::getConfigPaymentAction()
	 * @used-by \Df\Payment\R\Refund::stageNames()
	 * @return string[]
	 */
	public function stageNames() {return ['-stage', ''];}

	/**
	 * 2016-12-17
	 * @override
	 * @see \Df\Payment\R\Method::redirectUrl()
	 * @used-by \Df\Payment\R\Method::getConfigPaymentAction()
	 * @return string
	 */
	protected function redirectUrl() {return '';}
}