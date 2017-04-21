<?php
namespace Dfe\Klarna;
use Magento\Framework\View\Element\AbstractBlock as _P;
// 2017-04-21
class Button extends _P {
	/**
	 * 2017-04-21
	 * @override
	 * @see _P::_toHtml()
	 * @used-by \Magento\Framework\View\Element\AbstractBlock::toHtml()
	 * @return string
	 */
	final protected function _toHtml() {return 'TEST BUTTON';}
}