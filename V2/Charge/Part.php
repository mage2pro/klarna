<?php
namespace Dfe\Klarna\V2\Charge;
use Dfe\Klarna\V2\Charge;
use Magento\Sales\Model\Order as O;
/**
 * 2017-02-04
 * @see \Dfe\Klarna\V2\Charge\AddDiscount
 * @see \Dfe\Klarna\V2\Charge\Customer
 * @see \Dfe\Klarna\V2\Charge\Products
 * @see \Dfe\Klarna\V2\Charge\Shipping
 * @see \Dfe\Klarna\V2\Charge\ShippingAddress
 */
abstract class Part {
	/**
	 * 2017-02-04
	 * @param Charge $owner
	 */
	final function __construct(Charge $owner) {$this->_owner = $owner;}

	/**
	 * 2017-02-01
	 * @used-by \Dfe\Klarna\V2\Charge\AddDiscount::p()
	 * @used-by \Dfe\Klarna\V2\Charge\Products::p()
	 * @used-by \Dfe\Klarna\V2\Charge\Shipping::p()
	 * @param float $v
	 * @return int
	 */
	final protected function amount($v) {return round(100 * df_currency_convert(
		$v, $this->o()->getOrderCurrencyCode(), $this->owner()->currency()
	));}

	/**
	 * 2017-02-02
	 * @used-by \Dfe\Klarna\V2\Charge\AddDiscount::p()
	 * @used-by \Dfe\Klarna\V2\Charge\Part::amount()
	 * @used-by \Dfe\Klarna\V2\Charge\Products::p()
	 * @used-by \Dfe\Klarna\V2\Charge\Shipping::p()
	 * @return O
	 */
	final function o() {return dfc($this, function() {return df_order_r()->get('376');});}

	/**
	 * 2017-02-04
	 * @return Charge
	 */
	final protected function owner() {return $this->_owner;}

	/**
	 * 2017-02-04
	 * @used-by __construct()
	 * @used-by owner()
	 * @var Charge
	 */
	private $_owner;
}