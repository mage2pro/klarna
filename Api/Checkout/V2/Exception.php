<?php
namespace Dfe\Klarna\Api\Checkout\V2;
use \Throwable as T; # 2023-08-03 "Treat `\Throwable` similar to `\Exception`": https://github.com/mage2pro/core/issues/311
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
	 * @param T|\Klarna_Checkout_ApiErrorException $t
	 * @return array(string => mixed)
	 */
	protected function responseA(T $t):array {return $t->getPayload();}
}