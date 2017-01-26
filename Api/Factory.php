<?php
// 2017-01-25
namespace Dfe\Klarna\Api;
use Dfe\Klarna\Settings as S;
use Dfe\Klarna\UserAgent as UA;
use Klarna_Checkout_Connector as klConnector2;
use Klarna_Checkout_Order as klOrder2;
use Klarna\Rest\Checkout\Order as klOrder3;
use Klarna\Rest\Transport\Connector as klConnector3;
final class Factory {
	/**
	 * 2017-01-25
	 * @param S $s
	 * @param string $buyerCountry
	 * @return klOrder2|klOrder3
	 */
	public static function order(S $s, $buyerCountry) {
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
		return $isV2
			? new klOrder2(klConnector2::create($secret, $url))
			: new klOrder3(klConnector3::create($s->merchantID(), $secret, $url, new UA))
		;
	}
}