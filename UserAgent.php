<?php
// 2017-01-25
namespace Dfe\Klarna;
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
		$this->setField('Language', 'PHP', phpversion());
		/**
		 * 2017-01-25
		 * «Information about the SDK and version being used.
		 * Library/[Library name]_[version]
		 * Examples:
		 * Library/Klarna.SDK_1.0.0»
		 * https://github.com/klarna/kco_rest_php/blob/v2.2.0/src/Klarna/Rest/Transport/UserAgentInterface.php#L29-L35
		 */
        $this->setField('Library', 'mage2.pro', df_package_version($this), ['core/' . df_core_version()]);
		/**
		 * 2017-01-25
		 * «Information on what operating system the merchant is using for their web server.»
		 * https://github.com/klarna/kco_rest_php/blob/v2.2.0/src/Klarna/Rest/Transport/UserAgentInterface.php#L47-L53
		 * Реализацию взял из @see \Klarna\Rest\Transport\UserAgent::createDefault()
		 */
        $this->setField('OS', php_uname('s'), php_uname('r'));
	}
}