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
	 * @used-by message()
	 * @see \Dfe\Klarna\Api\Checkout\V2\Exception::responseA()
	 * @see \Dfe\Klarna\Api\Checkout\V3\Exception\Guzzle::responseA()
	 * @see \Dfe\Klarna\Api\Checkout\V3\Exception\Connector::responseA()
	 * @param \Exception $e
	 * @return array(string => mixed)
	 */
	abstract protected function responseA(\Exception $e);

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
	 * @return string
	 */
	final function message() {return df_api_rr_failed($this, $this->responseA($this->prev()), $this->req());}

	/**
	 * 2017-01-26
	 * @override
	 * @see \Df\Core\Exception::messageC()
	 * @return string
	 */
	final function messageC() {return dfp_error_message($this->prev()->getMessage());}

	/**
	 * 2017-01-26
	 * @used-by \Dfe\Klarna\Api\Checkout\V2\Exception::message()
	 * @return array(string => mixed)
	 */
	final protected function req() {return $this->_req;}

	/**
	 * 2017-01-26
	 * @used-by __construct()
	 * @used-by req()
	 * @var array(string => mixed)
	 */
	private $_req;
}