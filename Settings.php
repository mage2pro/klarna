<?php
// 2017-01-24
namespace Dfe\Klarna;
use Magento\Framework\App\ScopeInterface as IScope;
use Magento\Store\Model\Store;
/** @method static Settings s() */
final class Settings extends \Df\Payment\Settings {
	/**
	 * 2017-01-24
	 * @return string
	 */
	public function country() {return $this->testable();}

	/**
	 * 2017-01-24
	 * @override
	 * @see \Df\Payment\Settings::currency()
	 * @used-by \Df\Payment\Settings::_cur()
	 * @param null|string|int|IScope|Store $s [optional]
	 * @return string
	 */
	public function currency($s = null) {return $this->testable(null, $s);}

	/**
	 * 2017-01-24
	 * @used-by \Dfe\Klarna\Api\Factory::order()
	 * @return int
	 */
	public function merchantID() {return $this->testable();}

	/**
	 * 2017-01-24
	 * @used-by \Dfe\Klarna\Api\Factory::order()
	 * @return string
	 */
	public function sharedSecret() {return $this->testableP();}
}