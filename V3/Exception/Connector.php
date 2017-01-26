<?php
namespace Dfe\Klarna\V3\Exception;
/**
 * 2017-01-26
 * @see \Klarna\Rest\Transport\Connector::send():
 * 		throw new ConnectorException($data, $e);
 * https://github.com/klarna/kco_rest_php/blob/v2.2.0/src/Klarna/Rest/Transport/Connector.php#L142
 */
class Connector extends \Dfe\Klarna\V3\Exception {}