<?php
namespace Dfe\Klarna;
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
	 * @param \Exception $e
	 * @return array(string => mixed)
	 */
	abstract protected function responseA(\Exception $e):array;

	/**
	 * 2017-01-26
	 * @override
	 * @see \Df\Core\Exception::__construct()
	 * @used-by \Dfe\Klarna\Api\Checkout::html()
	 * @param \Exception $e
	 * @param array(string => mixed) $req
	 */
	final function __construct(\Exception $e, array $req) {$this->_req = $req; parent::__construct($e);}

	/**
	 * 2017-01-26
	 * @override
	 * @see \Df\Core\Exception::message()
	 * @used-by df_xts()
	 */
	final function message():string {return df_api_rr_failed($this, $this->responseA($this->prev()), $this->req());}

	/**
	 * 2017-01-26
	 * @override
	 * @see \Df\Core\Exception::messageC()
	 * @used-by \Df\Payment\PlaceOrderInternal::message()
	 */
	final function messageC():string {return dfp_error_message($this->prev()->getMessage());}

	/**
	 * 2017-01-26
	 * @used-by \Dfe\Klarna\Api\Checkout\V2\Exception::message()
	 * @return array(string => mixed)
	 */
	final protected function req() {return $this->_req;}

	/**
	 * 2017-01-26
	 * @used-by self::__construct()
	 * @used-by self::req()
	 * @var array(string => mixed)
	 */
	private $_req;
}