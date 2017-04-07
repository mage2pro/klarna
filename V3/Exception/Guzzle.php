<?php
namespace Dfe\Klarna\V3\Exception;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Message\ResponseInterface as IResponse;
/**
 * 2017-01-26
 * Исключительная ситуация этого класса возбуждается в 2 случаях:
 *
 * Случай 1)
 * Klarna нас не авторизовала:
 * @see \Klarna\Rest\Transport\Connector::send():
		if ($response->getHeader('Content-Type') !== 'application/json') {
			throw $e;
		}
 * https://github.com/klarna/kco_rest_php/blob/v2.2.0/src/Klarna/Rest/Transport/Connector.php#L132-L134
 * В этом случае ответ сервера имеет тип «text/html», а не «application/json».
 * При этом тело ответа пусто, а код HTTP ответа — 401.
 *
 * Случай 2)
 * Klarna вернула непонятный ответ:
 * @see \Klarna\Rest\Transport\Connector::send():
		$data = $response->json();
		if (!is_array($data) || !array_key_exists('error_code', $data)) {
			throw $e;
		}
 * https://github.com/klarna/kco_rest_php/blob/v2.2.0/src/Klarna/Rest/Transport/Connector.php#L136-L140
 *
 * @used-by \Dfe\Klarna\Api\Checkout::html()
 */
class Guzzle extends \Dfe\Klarna\V3\Exception {
	/**
	 * 2017-01-26
	 * @override
	 * @see \Dfe\Klarna\Exception::responseA()
	 * @used-by \Dfe\Klarna\Exception::message()
	 * @param \Exception|\GuzzleHttp\Exception\ClientException $e
	 * @return array(string => mixed)
	 */
	protected function responseA(\Exception $e) {
		/** @var IResponse|Response $r */
		$r = $e->getResponse();
		return [
			'HTTP Status Code' => $r->getStatusCode()
			,'Reason' => $r->getReasonPhrase()
		];
	}
}