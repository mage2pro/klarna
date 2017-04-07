<?php
namespace Dfe\Klarna\V2;
/**
 * 2017-01-26
 * @used-by \Dfe\Klarna\Api\Checkout::html()
 */
final class Exception extends \Dfe\Klarna\Exception {
	/**
	 * 2017-01-26
	 * @override
	 * @see \Dfe\Klarna\Exception::responseA()
	 * @used-by \Dfe\Klarna\Exception::message()
	 * @param \Exception|\Klarna_Checkout_ApiErrorException $e
	 * @return array(string => mixed)
	 */
	protected function responseA(\Exception $e) {return $e->getPayload();}
}