<?php
// 2017-01-24
namespace Dfe\Klarna;
/** @method static Settings s() */
final class Settings extends \Df\Payment\Settings {
	/**
	 * 2017-01-24
	 * https://developers.klarna.com/api/?json#api-urls
	 * https://github.com/klarna/kco_rest_php/blob/v2.2.0/src/Klarna/Rest/Transport/ConnectorInterface.php#L37-L55
	 * @return string
	 */
	public function apiUrl() {return dfc($this, function() {return
		sprintf('https://api%s%s.klarna.com/',
			'US' === $this->country() ? '-na' : ''
			,$this->test() ? '.playground' : ''
		)
	;});}

	/**
	 * 2016-12-24  
	 * @used-by apiUrl()
	 * @return string
	 */
	public function country() {return $this->testable();}

	/**
	 * 2016-12-24
	 * @return string
	 */
	public function currency() {return $this->testable();}

	/**
	 * 2016-12-24
	 * @return int
	 */
	public function merchantID() {return $this->testable();}

	/**
	 * 2016-12-24
	 * @return string
	 */
	public function sharedSecret() {return $this->testableP();}
}