<?php
// 2017-01-24
namespace Dfe\Klarna;
use Magento\Framework\App\ScopeInterface as IScope;
use Magento\Store\Model\Store;
/** @method static Settings s() */
final class Settings extends \Df\Payment\Settings {
	/**
	 * 2017-01-24
	 * https://developers.klarna.com/api/?json#api-urls
	 * https://github.com/klarna/kco_rest_php/blob/v2.2.0/src/Klarna/Rest/Transport/ConnectorInterface.php#L37-L55
	 * 2017-01-25
	 * @todo Как оказалось, адреса API зависят не от страны продавца, а от страны покупателя:
	 * «Are the Klarna's API URLs based on a merchant's country or on a buyer's country?»
	 * https://mage2.pro/t/2517
	 * «Why are Klarna's API URLs for USA buyers different from others?» https://mage2.pro/t/2516
	 * Поэтому текущий алгоритм неверен и нуждается в переделке.
	 * @param string $buyerCountryIso2
	 * @return string
	 */
	public function apiUrl($buyerCountryIso2) {return
		sprintf('https://api%s%s.klarna.com/',
			'US' === $buyerCountryIso2 ? '-na' : ''
			,$this->test() ? '.playground' : ''
		)
	;}

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
	 * @return int
	 */
	public function merchantID() {return $this->testable();}

	/**
	 * 2017-01-24
	 * @return string
	 */
	public function sharedSecret() {return $this->testableP();}
}