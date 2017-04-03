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
		quote.billingAddress.subscribe(
			/**
			 * 2017-04-04
			 * newAddress is null if a customer has just unchecked
			 * the «My billing and shipping address are the same» checkbox,
			 * but does not select another address yet.
			 * @param {?Object} newAddress
			 */
			function(newAddress) {
				debugger;
			}
		);
		return this;
	},
});});
