<?php
namespace Dfe\Klarna;
# 2017-01-24
/** @method static Settings s() */
final class Settings extends \Df\Payment\Settings {
	/**
	 * 2017-01-24
	 * @used-by \Dfe\Klarna\Api\Checkout::html()
	 * @return string
	 */
	function sharedSecret() {return $this->testableP();}
}