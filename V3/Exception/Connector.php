<?php
namespace Dfe\Klarna\V3\Exception;
/**
 * 2017-01-26
 * @see \Klarna\Rest\Transport\Connector::send():
 * 		throw new ConnectorException($data, $e);
 * https://github.com/klarna/kco_rest_php/blob/v2.2.0/src/Klarna/Rest/Transport/Connector.php#L142
 * @used-by \Dfe\Klarna\Api::order()
 */
class Connector extends \Dfe\Klarna\V3\Exception {
	/**
	 * 2017-01-26
	 * @override
	 * @see \Dfe\Klarna\Exception::responseA()
	 * @used-by \Dfe\Klarna\Exception::message()
	 * @param \Exception|\Klarna\Rest\Transport\Exception\ConnectorException $e
	 * @return array(string => mixed)
	 */
	protected function responseA(\Exception $e) {return [];}
}