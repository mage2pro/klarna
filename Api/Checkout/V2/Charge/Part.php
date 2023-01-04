<?php
namespace Dfe\Klarna\Api\Checkout\V2\Charge;
use Dfe\Klarna\Api\Checkout\V2\Charge;
use Magento\Sales\Model\Order as O;
use Magento\Quote\Model\Quote as Q;
/**
 * 2017-02-04
 * @see \Dfe\Klarna\Api\Checkout\V2\Charge\AddDiscount
 * @see \Dfe\Klarna\Api\Checkout\V2\Charge\Customer
 * @see \Dfe\Klarna\Api\Checkout\V2\Charge\Products
 * @see \Dfe\Klarna\Api\Checkout\V2\Charge\Shipping
 * @see \Dfe\Klarna\Api\Checkout\V2\Charge\ShippingAddress
 */
abstract class Part {
	/**
	 * 2017-02-04
	 */
	final function __construct(Charge $owner) {$this->_owner = $owner;}

	/**
	 * 2017-02-01
	 * @used-by \Dfe\Klarna\Api\Checkout\V2\Charge\AddDiscount::p()
	 * @used-by \Dfe\Klarna\Api\Checkout\V2\Charge\Products::p()
	 * @used-by \Dfe\Klarna\Api\Checkout\V2\Charge\Shipping::p()
	 */
	final protected function amount(float $v):int {return round(100 * df_currency_convert(
		$v, df_oq_currency_c($this->oq()), $this->owner()->currency()
	));}

	/**
	 * 2017-02-02
	 * @used-by \Dfe\Klarna\Api\Checkout\V2\Charge\AddDiscount::p()
	 * @used-by \Dfe\Klarna\Api\Checkout\V2\Charge\Part::amount()
	 * @used-by \Dfe\Klarna\Api\Checkout\V2\Charge\Products::p()
	 * @used-by \Dfe\Klarna\Api\Checkout\V2\Charge\Shipping::p()
	 * @return O|Q
	 */
	final function oq() {return dfc($this, function() {return df_quote('535');});}

	/**
	 * 2017-02-04
	 */
	final protected function owner():Charge {return $this->_owner;}

	/**
	 * 2017-02-04
	 * @used-by self::__construct()
	 * @used-by self::owner()
	 * @var Charge
	 */
	private $_owner;
}