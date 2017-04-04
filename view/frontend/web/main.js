// 2016-12-17
define([
	'Df_Payment/custom', 'Magento_Checkout/js/model/quote'
], function(parent, quote) {'use strict'; return parent.extend({
	defaults: {
		df: {
			test: {showBackendTitle: false},
			// 2016-12-17
			// @used-by Df_Payment/main
			// https://github.com/mage2pro/core/blob/2.4.21/Payment/view/frontend/web/template/main.html#L36-L38
			formTemplate: 'Dfe_Klarna/form'
		}
	},
	/**
	 * 2017-04-04
	 * @override
	 * @see Df_Payment/card::initialize()
	 * https://github.com/mage2pro/core/blob/2.4.21/Payment/view/frontend/web/card.js#L77-L110
	 * @returns {Object}
	*/
	initialize: function() {
		this._super();
		/** @type {?Object} */
		var prevAddress;
		quote.billingAddress.subscribe(
			/**
			 * 2017-04-04
			 * newAddress is null if a customer has just unchecked
			 * the «My billing and shipping address are the same» checkbox,
			 * but does not select another address yet.
			 * @used-by Magento_Checkout/js/action/select-billing-address:
			 * 		quote.billingAddress(address);
			 * https://github.com/magento/magento2/blob/2.1.5/app/code/Magento/Checkout/view/frontend/web/js/action/select-billing-address.js#L23
			 * @param {?Object} newAddress
			 */
			function(newAddress) {
				/**
				 * 2017-04-04
				 * Note #1
				 * Naive newAddress !== prevAddress does not work correctly.
				 * @uses Magento_Customer/js/model/customer/address::getKey()
				 *	getKey: function() {
				 *		return this.getType() + this.customerAddressId;
				 *	}
				 * https://github.com/magento/magento2/blob/2.1.5/app/code/Magento/Customer/view/frontend/web/js/model/customer/address.js#L48-L50
				 * It returns a string like «customer-address4».
				 * Note #2
				 * !newAddress ^ !prevAddress is for situations
				 * when newAddress or prevAddress is null or prevAddress is undefined:
				 * http://stackoverflow.com/a/4540443
				 */
				if (!newAddress ^ !prevAddress || newAddress.getKey() !== prevAddress.getKey()) {
					prevAddress = newAddress;
					if (newAddress) {
						console.log(newAddress);
					}
				}
			}
		);
		return this;
	},
});});
