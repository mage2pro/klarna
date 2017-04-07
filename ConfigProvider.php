<?php
namespace Dfe\Klarna;
use Dfe\Klarna\Api\Checkout as C;
// 2017-04-03
final class ConfigProvider extends \Df\Payment\ConfigProvider {
	/**
	 * 2017-04-03
	 * @override
	 * @see \Df\Payment\ConfigProvider::config()
	 * @used-by \Df\Payment\ConfigProvider::getConfig()
	 * @return array(string => mixed)
	 */
	protected function config() {return ['html' => C::html('SE')] + parent::config();}
}