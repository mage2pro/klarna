<?php
// 2017-01-25
namespace Dfe\Klarna;
use Dfe\Klarna\Settings as S;
use Dfe\Klarna\UserAgent as UA;
use Dfe\Klarna\V2\Charge as Charge2;
use Dfe\Klarna\V3\Charge as Charge3;
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
	 * Returns a Klarna's HTML snippet: https://mage2.pro/t/2544
	 * @param string $bCountry
	 * @return string
	 * @throws Exception2 
	 * @throws Exception3_Guzzle
	 * @throws Exception3_Connector
	 */
	static function order($bCountry) {
		/** @var S $s */
		$s = dfps(__CLASS__);
		/** @var bool $isV2 */
		$isV2 = !in_array($bCountry, ['GB', 'US']);
		/** @var array(string => mixed) $request */
		$request = $isV2 ? Charge2::p($bCountry) : Charge3::p();
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
			$isV2 ? 'checkout' : ('api' . ('US' === $bCountry ? '-na' : ''))
			,!$s->test() ? '' : ('.' . ($isV2 ? 'testdrive' : 'playground'))
		);
		/** @var string $secret */
		$secret = $s->sharedSecret();
		/** @var klOrder2|klOrder3 $klOrder */
		$klOrder = $isV2
			? new klOrder2(klConnector2::create($secret, $url))
			: new klOrder3(klConnector3::create($s->merchantID(), $secret, $url, new UA))
		;
		try {
			/**
			 * 2017-01-28
			 * Комментарий ниже написан на основании эксперимента с API версии 2.
			 * С API версии 3 ещё не экспериментировал (всё ещё не имею доступов).
			 * -----
			 * В случае успеха запроса сервер отвечает с кодом HTTP 201,
			 * и возвращает заголовок «Location» со значением типа
			 * https://checkout.testdrive.klarna.com/checkout/orders/FZDFH925D9OXLTC9DB5Y2C22IVT
			 *
			 * Klarna SDK обрабатывает эту ситуацию в методе
			 * @see \Klarna_Checkout_BasicConnector::handleResponse():
			 *		case 201:
			 *			// Update Location
			 *			$resource->setLocation($url);
			 *			break;
			 * https://github.com/klarna/kco_php/blob/v4.0.0/src/Klarna/Checkout/BasicConnector.php#L287-L290
			 */
			$klOrder->create($request);
			/**
			 * 2017-01-28
			 * Checkout API версии 2.
			 * https://developers.klarna.com/en/se/kco-v2/checkout/2-embed-the-checkout#render-checkout-snippet
			 * «You should now fetch the order from Klarna’s system
			 * and store the order ID in the session.
			 * The checkout order now contains an HTML snippet under the gui.snippet property.
			 * You should extract the HTML snippet and display it on your checkout page.»
			 *
			 * Checkout API версии 3.
			 * https://developers.klarna.com/en/us/kco-v3/checkout/2-render-the-checkout#render-checkout-snippet
			 * «You should now fetch the order from Klarna’s system
			 * and store the order ID in the session.
			 * The checkout order now contains an HTML snippet under the html_snippet property.
			 * You should extract the HTML snippet and display it on your checkout page.»
			 *
			 * Как видно из этих описаний и из примеров документации,
			 * API версии 2 и 3 на этом шаге различаются лишь
			 * размещением кода HTML после операции fetch():
			 *
			 * Checkout API версии 2: код HTML размещается во вложенном свойстве «gui.snippet»:
			 * $snippet = $order['gui']['snippet'];
			 * Пример кода HTML: https://mage2.pro/t/2544
			 *
			 * Checkout API версии 3: код HTML размещается во вложенном свойстве «html_snippet»:
			 * $snippet = $order['html_snippet'];
			 *
			 * Комментарий ниже написан на основании эксперимента с API версии 2.
			 * С API версии 3 ещё не экспериментировал (всё ещё не имею доступов).
			 * -----
			 * Также мы можем получить:
			 *
			 * 1) Идентификатор транзакции: $order['id']
			 * Он имеет вид типа «FZDFH925D9OXLTC9DB5Y2C22IVT»
			 * Это именно то значение, которое мы получили ранее
			 * в ответе от сервера на операцию $order->create($request):
			 * https://github.com/mage2pro/klarna/blob/0.0.6/Api.php?ts=4#L83-L95
			 * «В случае успеха запроса сервер отвечает с кодом HTTP 201,
			 * и возвращает заголовок «Location» со значением типа
			 * https://checkout.testdrive.klarna.com/checkout/orders/FZDFH925D9OXLTC9DB5Y2C22IVT»
			 *
			 * 2) Состояние транзакции: $order['status']
			 * В моём эксперименте оно равно «checkout_incomplete».
			 * Скорее всего, таким оно и должно быть на этой стадии:
			 * https://developers.klarna.com/en/se/kco-v2/checkout/2-embed-the-checkout#embed-checkout
			 * «When you create an order in Klarna’s system it will have the status checkout_incomplete.»
			 *
			 * Как косвенно следует из документации к версии 3,
			 * там тоже состояние равно «checkout_incomplete»:
			 * https://developers.klarna.com/api/#checkout-api-update-an-order
			 * Хотя в примерах (правая колонка) это состояние записано заглавными буквами:
			 * "status": "CHECKOUT_INCOMPLETE"
			 */
			$klOrder->fetch();
			/** @var string $orderId */
			//$orderId = $order['id'];
			if ($isV2) {
				dfp_log_l(__CLASS__, $klOrder->marshal(), strtolower($bCountry));
			}
			/** @var string $html */
			return $isV2 ? $klOrder['gui']['snippet'] : $klOrder['html_snippet'];
		}
		/**
		 * 2017-01-26
		 * Checkout API версии 2.
		 * Для получения диагностической информации можно использовать метод
		 * @see \Klarna_Checkout_ApiErrorException::getPayload()
		 * Он возвращает массив следующей структуры:
		 *		{
		 *			"http_status_code": 400,
		 *			"http_status_message": "Bad Request",
		 *			"internal_message": "Bad format: 'shipping_countries' is not part of the schema"
		 *		}
		 * В то же время простое $e->getMessage() вернёт просто «API Error».
		 * @see \Klarna_Checkout_BasicConnector::verifyResponse():
		 *		throw new Klarna_Checkout_ApiErrorException(
		 *			"API Error", $result->getStatus(), $payload
		 *		);
		 * https://github.com/klarna/kco_php/blob/v4.0.0/src/Klarna/Checkout/BasicConnector.php#L237-L239
		 */
		catch (\Klarna_Checkout_ApiErrorException $e) {
			throw new Exception2($e, $request);
		}
		/**
		 * 2017-01-26
		 * Checkout API версии 3.
		 * Сюда мы попадаем в 2 случаях, описанных здесь:
		 * https://github.com/mage2pro/klarna/blob/0.0.5/V3/Exception/Guzzle.php?ts=4#L7-L24
		 */
		catch (\GuzzleHttp\Exception\ClientException $e) {
			throw new Exception3_Guzzle($e, $request);
		}
		/**
		 * 2017-01-26
		 * Checkout API версии 3.
		 * Сюда мы попадаем в случае, описанном здесь:
		 * https://github.com/mage2pro/klarna/blob/0.0.5/V3/Exception/Connector.php?ts=4#L5-L7
		 */
		catch (\Klarna\Rest\Transport\Exception\ConnectorException $e) {
			throw new Exception3_Connector($e, $request);
		}
	}
}