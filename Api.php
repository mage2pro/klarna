<?php
// 2017-01-25
namespace Dfe\Klarna;
use Dfe\Klarna\Settings as S;
use Dfe\Klarna\UserAgent as UA;
use Dfe\Klarna\V2\Exception as Exception2;
use Dfe\Klarna\V3\Exception\Guzzle as Exception3_Guzzle;
use Dfe\Klarna\V3\Exception\Guzzle as Exception3_Connector;
use Klarna_Checkout_Connector as klConnector2;
use Klarna_Checkout_Order as klOrder2;
use Klarna\Rest\Checkout\Order as klOrder3;
use Klarna\Rest\Transport\Connector as klConnector3;
final class Api {
	/**
	 * 2017-01-25
	 * @param S $s
	 * @param string $buyerCountry
	 * @param array(string => mixed) $request
	 * @throws Exception2 
	 * @throws Exception3_Guzzle
	 * @throws Exception3_Connector
	 */
	public static function order(S $s, $buyerCountry, array $request) {
		/** @var bool $isV2 */
		$isV2 = !in_array($buyerCountry, ['GB', 'US']);
		/**
		 * 2017-01-24
		 * https://developers.klarna.com/api/?json#api-urls
		 * https://github.com/klarna/kco_rest_php/blob/v2.2.0/src/Klarna/Rest/Transport/ConnectorInterface.php#L37-L55
		 * 2017-01-25
		 * @todo Как оказалось, адреса API зависят не от страны продавца, а от страны покупателя:
		 * «Are the Klarna's API URLs based on a merchant's country or on a buyer's country?»
		 * https://mage2.pro/t/2517
		 * «Why are Klarna's API URLs for USA buyers different from others?» https://mage2.pro/t/2516
		 * Поэтому текущий алгоритм неверен и нуждается в переделке.
		 *
		 * 2017-01-26
		 * Слеш на конце не нужен:
		 *
		 * API версии 2:
		 * https://github.com/klarna/kco_php/blob/v4.0.0/src/Klarna/Checkout/Connector.php#L43-L51
		 *
		 * 2.1) @see \Klarna_Checkout_Connector::BASE_TEST_URL
		 * https://checkout.testdrive.klarna.com
		 *
		 * 2.2) @see \Klarna_Checkout_Connector::BASE_URL
		 * https://checkout.klarna.com
		 *
		 * API версии 3:
		 * https://github.com/klarna/kco_rest_php/blob/v2.2.0/src/Klarna/Rest/Transport/ConnectorInterface.php#L37-L55
		 *
		 * 3.1) @see \Klarna\Rest\Transport\ConnectorInterface::EU_BASE_URL
		 * https://api.klarna.com
		 *
		 * 3.2) @see \Klarna\Rest\Transport\ConnectorInterface::EU_TEST_BASE_URL
		 * https://api.playground.klarna.com
		 *
		 * 3.3) @see \Klarna\Rest\Transport\ConnectorInterface::NA_BASE_URL
		 * https://api-na.klarna.com
		 *
		 * 3.4) @see \Klarna\Rest\Transport\ConnectorInterface::NA_TEST_BASE_URL
		 * https://api-na.playground.klarna.com
		 *
		 * @var string $url
		 */
		$url = sprintf('https://%s%s.klarna.com',
			$isV2 ? 'checkout' : ('api' . ('US' === $buyerCountry ? '-na' : ''))
			,!$s->test() ? '' : ('.' . ($isV2 ? 'testdrive' : 'playground'))
		);
		/** @var string $secret */
		$secret = $s->sharedSecret();
		/** @var klOrder2|klOrder3 $order */
		$order = $isV2
			? new klOrder2(klConnector2::create($secret, $url))
			: new klOrder3(klConnector3::create($s->merchantID(), $secret, $url, new UA))
		;
		try {
			$order->create($request);
		}
		/**
		 * 2017-01-26
		 * Checkout API версии 2.
		 * Для получения диагностической информации можно использовать метод
		 * @see \Klarna_Checkout_ApiErrorException::getPayload()
		 * Он возвращает массив следующей структуры:
				{
					"http_status_code": 400,
					"http_status_message": "Bad Request",
					"internal_message": "Bad format: 'shipping_countries' is not part of the schema"
				}
		 * В то же время простое $e->getMessage() вернёт просто «API Error».
		 * @see \Klarna_Checkout_BasicConnector::verifyResponse():
				throw new Klarna_Checkout_ApiErrorException(
					"API Error", $result->getStatus(), $payload
				);
		 * https://github.com/klarna/kco_php/blob/v4.0.0/src/Klarna/Checkout/BasicConnector.php#L237-L239
		 */
		catch (\Klarna_Checkout_ApiErrorException $e) {
			throw new Exception2($e, $request);
		}
		/**
		 * 2017-01-26
		 * Checkout API версии 3.
		 * Сюда мы попадаем в 2 случаях:
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
		 */
		catch (\GuzzleHttp\Exception\ClientException $e) {
			throw new Exception3_Guzzle($e, $request);
		}
	}
}