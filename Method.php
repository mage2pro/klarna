<?php
# 2016-12-17
namespace Dfe\Klarna;
use Magento\Sales\Model\Order as O;
use Magento\Sales\Model\Order\Address as OrderAddress;
use Magento\Sales\Model\Order\Payment as OP;
final class Method extends \Df\Payment\Method {
	/**
	 * 2017-02-08
	 * @override
	 * The result should be in the basic monetary unit (like dollars), not in fractions (like cents).
	 * I did not find such information on the Klarna website.
	 * «Does Klarna have minimum and maximum amount limitations on a single payment?»
	 * https://mage2.pro/t/2685
	 * https://mail.google.com/mail/u/0/#sent/15a1f2017e51d43e
	 * @see \Df\Payment\Method::amountLimits()
	 * @used-by \Df\Payment\Method::isAvailable()
	 * @return null
	 */
	protected function amountLimits() {return null;}
}