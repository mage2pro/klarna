<?php
// 2017-01-24
namespace Dfe\Klarna;
use Magento\Framework\App\ScopeInterface as IScope;
use Magento\Store\Model\Store;
/** @method static Settings s() */
final class Settings extends \Df\Payment\Settings {
	/**
	 * 2017-01-24
	 * @used-by \Dfe\Klarna\Api::order()
	 * @return int
	 */
	function merchantID() {return $this->testable();}

	/**
	 * 2017-01-24
	 * @used-by \Dfe\Klarna\Api::order()
	 * @return string
	 */
	function sharedSecret() {return $this->testableP();}
}