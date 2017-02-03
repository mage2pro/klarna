<?php
//
namespace Dfe\Klarna\V2\Charge;
use Dfe\Klarna\V2\Charge;
/**
 * 2017-02-04
 * @see \Dfe\Klarna\V2\Charge\AddDiscount
 * @see \Dfe\Klarna\V2\Charge\Products
 * @see \Dfe\Klarna\V2\Charge\ShippingAddress
 */
abstract class Part {
	/**
	 * 2017-02-04
	 * @param Charge $owner
	 */
	final public function __construct(Charge $owner) {$this->_owner = $owner;}

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