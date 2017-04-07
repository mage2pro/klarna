<?php
namespace Dfe\Klarna\Api\Checkout\V3\Exception;
/**
 * 2017-01-26
 * @see \Klarna\Rest\Transport\Connector::send():
 * 		throw new ConnectorException($data, $e);
 * https://github.com/klarna/kco_rest_php/blob/v2.2.0/src/Klarna/Rest/Transport/Connector.php#L142
 * @used-by \Dfe\Klarna\Api\Checkout::html()
 */
class Connector extends \Dfe\Klarna\Api\Checkout\V3\Exception {
	/**
	 * 2017-01-26
	 * @override
	 * @see \Dfe\Klarna\Exception::responseA()
	 * @used-by \Dfe\Klarna\Exception::message()
	 * @param \Exception|\Klarna\Rest\Transport\Exception\ConnectorException $e
	 * @return array(string => mixed)
	 * @todo Ещё не реализовано, потому что у меня нет пока доступов к API версии 3:
	 * https://mage2.pro/t/2531
	 */
	protected function responseA(\Exception $e) {return [];}
}