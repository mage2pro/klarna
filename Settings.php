<?php
// 2017-01-24
namespace Dfe\Klarna;
/** @method static Settings s() */
final class Settings extends \Df\Payment\Settings {
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