<?php
namespace Dfe\Klarna\Observer;
use Dfe\Klarna\Button;
use Magento\Catalog\Block\ShortcutButtons as Container;
use Magento\Checkout\Block\QuoteShortcutButtons as MiniContainer;
use Magento\Framework\Event\Invoker\InvokerDefault as Invoker;
use Magento\Framework\Event\Observer as O;
use Magento\Framework\Event\ObserverInterface as IO;
/**
 * 2017-04-21
 * Event: «shortcut_buttons_container».
 * How is the «shortcut_buttons_container» event triggered and handled? https://mage2.pro/t/3786
 * 1. @see \Magento\Catalog\Block\ShortcutButtons::_beforeToHtml()
 * 	 	$this->_eventManager->dispatch(
 *	 		'shortcut_buttons_container',
 *			[
 *				'container' => $this,
 *				'is_catalog_product' => $this->_isCatalogProduct,
 *				'or_position' => $this->_orPosition
 *			 ]
 *		 );
 * https://github.com/magento/magento2/blob/c3040d36/app/code/Magento/Catalog/Block/ShortcutButtons.php#L66-L81
 * 2. @see \Magento\Checkout\Block\QuoteShortcutButtons::_beforeToHtml()
 *		$this->_eventManager->dispatch(
 *			'shortcut_buttons_container',
 *			[
 *				'container' => $this,
 *				'is_catalog_product' => $this->_isCatalogProduct,
 *				'or_position' => $this->_orPosition,
 *				'checkout_session' => $this->_checkoutSession
 *			]
 *		);
 * https://github.com/magento/magento2/blob/c3040d36/app/code/Magento/Checkout/Block/QuoteShortcutButtons.php#L32-L49
 * Our goal is add the «Check out with Klarna» button to the customer's cart,
 * similarly to the «Check out with PayPal» button
 * «How is the «Check out with PayPal» button implemented?» https://mage2.pro/t/3785
 */
final class ShortcutButtonsContainer implements IO {
	/**
	 * 2017-04-21
	 * @see \Magento\Checkout\Block\QuoteShortcutButtons (MiniContainer)
	 * inherits from @see \Magento\Catalog\Block\ShortcutButtons (Container),
	 * so they both have the @uses \Magento\Catalog\Block\ShortcutButtons::addShortcut() method.
	 * @override
	 * @see IO::execute()
	 * @used-by Invoker::_callObserverMethod()
	 * @param O $o
	 */
	function execute(O $o) {
		if (dfps($this)->enable()) {
			/** @var Container|MiniContainer $c */
			$c = $o['container'];
			$c->addShortcut(df_block(Button::class));
		}
	}
}

