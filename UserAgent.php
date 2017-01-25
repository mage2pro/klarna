<?php
// 2017-01-25
namespace Dfe\Klarna;
/**
 * 2017-01-25
 * @see \Klarna\Rest\Transport\Connector::createRequest()
 * 		$options['headers']['User-Agent'] = strval($this->userAgent);
 * https://github.com/klarna/kco_rest_php/blob/v2.2.0/src/Klarna/Rest/Transport/Connector.php#L105
 */
class UserAgent extends \Klarna\Rest\Transport\UserAgent {
	/**
	 * 2017-01-25
	 * @override
	 * @see \Klarna\Rest\Transport\UserAgent::__construct()
	 */
	public function __construct() {
		parent::__construct();
		/**
		 * 2017-01-25
		 * «This is used to indicate which programming language and version is being used.»
		 * https://github.com/klarna/kco_rest_php/blob/v2.2.0/src/Klarna/Rest/Transport/UserAgentInterface.php#L38-L39
		 * Реализацию взял из @see \Klarna\Rest\Transport\UserAgent::createDefault()
		 */
		$this->f('Language', 'PHP', phpversion());
		/**
		 * 2017-01-25
		 * «Information about the SDK and version being used.
		 * Library/[Library name]_[version]
		 * Examples:
		 * Library/Klarna.SDK_1.0.0»
		 * https://github.com/klarna/kco_rest_php/blob/v2.2.0/src/Klarna/Rest/Transport/UserAgentInterface.php#L29-L35
		 * Реализовал по аналогии с @see \Klarna\Rest\Transport\UserAgent::createDefault()
		 */
        $this->f('Library', static::NAME, static::VERSION);
		/**
		 * 2017-01-25
		 * «This is used to indicate if the integration is done using a partner.»
		 * https://github.com/klarna/kco_rest_php/blob/v2.2.0/src/Klarna/Rest/Transport/UserAgentInterface.php#L65-L72
		 */
        $this->f('Module', 'mage2.pro', df_package_version($this), ['core/' . df_core_version()]);
		/**
		 * 2017-01-25
		 * «Information on what operating system the merchant is using for their web server.»
		 * https://github.com/klarna/kco_rest_php/blob/v2.2.0/src/Klarna/Rest/Transport/UserAgentInterface.php#L47-L53
		 * Реализацию взял из @see \Klarna\Rest\Transport\UserAgent::createDefault()
		 */
        $this->f('OS', php_uname('s'), php_uname('r'));
		/**
		 * 2017-01-25
		 * «This is used to indicate if the integration is done using a partner.»
		 * https://github.com/klarna/kco_rest_php/blob/v2.2.0/src/Klarna/Rest/Transport/UserAgentInterface.php#L56-L62
		 * Хотел поставить здесь значение «https://mage2.pro/c/extensions/klarna»,
		 * но тогда слеши URL будут перемешаны со слешами User-Agent:
		 * «Language/PHP_5.6.22 <...> Partner/https://mage2.pro/c/extensions/klarna <...>»
		 * Не уверен, что Klarna это корректно обработает.
		 */
        $this->f('Partner', 'mage2.pro');
		/**
		 * 2017-01-25
		 * «This is used to indicate if the integration is done using a partner.»
		 * https://github.com/klarna/kco_rest_php/blob/v2.2.0/src/Klarna/Rest/Transport/UserAgentInterface.php#L65-L72
		 */
        $this->f('Platform', 'Magento', df_magento_version());
		/**
		 * 2017-01-25
		 * «Information about the web server being used.»
		 * https://github.com/klarna/kco_rest_php/blob/v2.2.0/src/Klarna/Rest/Transport/UserAgentInterface.php#L85-L93
		 */
        $this->f('Webserver', ...df_webserver(true));
	}

	/**
	 * 2017-01-25
     * @param string $key
     * @param string $name
     * @param string $version [optional]
     * @param string[] $options [optional]
	 */
	private function f($key, $name, $version = '', array $options = []) {
		$this->setField($key, $name, $version, $options);
	}
}