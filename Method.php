<?php
// 2016-12-17
namespace Dfe\Klarna;
use Magento\Sales\Model\Order as O;
use Magento\Sales\Model\Order\Address as OrderAddress;
use Magento\Sales\Model\Order\Payment as OP;
class Method extends \Df\PaypalClone\Method {
	/**
	 * 2016-12-17
	 * Первый параметр — для test, второй — для live.
	 * @override
	 * @see \Df\PaypalClone\Method::stageNames()
	 * @used-by \Df\PaypalClone\Method::url()
	 * @used-by \Df\PaypalClone\Refund::stageNames()
	 * @return string[]
	 */
	public function stageNames() {return ['-stage', ''];}

	/**
	 * 2016-12-17
	 * @override
	 * @see \Df\PaypalClone\Method::redirectUrl()
	 * @used-by \Df\PaypalClone\Method::getConfigPaymentAction()
	 * @return string
	 */
	protected function redirectUrl() {return '';}
}