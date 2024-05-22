<?php
namespace Dfe\Klarna;
use \Throwable as T; # 2023-08-03 "Treat `\Throwable` similar to `\Exception`": https://github.com/mage2pro/core/issues/311
/**
 * 2017-01-26
 * @see \Dfe\Klarna\Api\Checkout\V2\Exception
 * @see \Dfe\Klarna\Api\Checkout\V3\Exception
 */
abstract class Exception extends \Df\Payment\Exception {
	/**
	 * 2017-01-26
	 * @used-by self::message()
	 * @see \Dfe\Klarna\Api\Checkout\V2\Exception::responseA()
	 * @see \Dfe\Klarna\Api\Checkout\V3\Exception\Guzzle::responseA()
	 * @see \Dfe\Klarna\Api\Checkout\V3\Exception\Connector::responseA()
	 * @return array(string => mixed)
	 */
	abstract protected function responseA(T $t):array;

	/**
	 * 2017-01-26
	 * @override
	 * @see \Df\Core\Exception::__construct()
	 * @used-by \Dfe\Klarna\Api\Checkout::html()
	 * @param array(string => mixed) $req
	 */
	final function __construct(T $t, array $req) {$this->_req = $req; parent::__construct($t);}

	/**
	 * 2017-01-26
	 * @override
	 * @see \Df\Core\Exception::message()
	 * @used-by df_xts()
	 * @used-by \Df\Core\Exception::throw_()
	 */
	final function message():string {return df_api_rr_failed($this, $this->responseA($this->prev()), $this->req());}

	/**
	 * 2017-01-26
	 * @override
	 * @see \Df\Core\Exception::messageC()
	 * @used-by \Df\Payment\PlaceOrderInternal::message()
	 */
	final function messageC():string {return dfp_error_message(df_xts($this->prev()));}

	/**
	 * 2017-01-26
	 * @used-by \Dfe\Klarna\Api\Checkout\V2\Exception::message()
	 * @return array(string => mixed)
	 */
	final protected function req():array {return $this->_req;}

	/**
	 * 2017-01-26
	 * @used-by self::__construct()
	 * @used-by self::req()
	 * @var array(string => mixed)
	 */
	private $_req;
}