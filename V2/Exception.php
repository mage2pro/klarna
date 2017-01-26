<?php
namespace Dfe\Klarna\V2;
use Klarna_Checkout_ApiErrorException as E;
/**
 * 2017-01-26
 * @method E prev()
 */
final class Exception extends \Dfe\Klarna\Exception {
	/**
	 * 2017-01-26
	 * @override
	 * @see \Df\Core\Exception::__construct()
	 * @used-by \Dfe\Klarna\Api::order()
	 * @param E $e
	 * @param array(string => mixed) $req
	 */
	public function __construct(E $e, array $req) {
		$this->_req = $req;
		parent::__construct($e);
	}

	/**
	 * 2017-01-26
	 * @override
	 * @see \Df\Core\Exception::message()
	 * @return string
	 */
	public function message() {return df_cc_n(
		'The Klarna request is failed.'
		,"Response:", df_json_encode_pretty($this->prev()->getPayload())
		,'Request:', df_json_encode_pretty($this->_req)
	);}

	/**
	 * 2017-01-26
	 * @override
	 * @see \Df\Core\Exception::messageC()
	 * @return string
	 */
	public function messageC() {return dfp_error_message($this->prev()->getMessage());}

	/**
	 * 2017-01-26
	 * @used-by __construct()
	 * @var array(string => mixed)
	 */
	private $_req;
}