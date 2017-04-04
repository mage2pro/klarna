// 2016-12-17
define([
	'df'
	,'Df_Payment/billingAddressChange'
	,'Df_Payment/custom'
	,'ko'
	,'Magento_Checkout/js/model/quote'
	,'Magento_Checkout/js/model/url-builder'
	,'Magento_Customer/js/model/customer'
], function(df, billingAddressChange, parent, ko, q, ub, customer) {'use strict'; return parent.extend({
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
		this.klHtml = ko.observable(this.config('html'));
		var _this = this;
		billingAddressChange(function(newAddress) {
			if (newAddress.countryId) {
				// 2017-04-04
				// The M2 client part does not notify the server part about the billing address change.
				// So we need to pass the chosen country ID to the server part.
				//console.log(newAddress.countryId);
				_this.klHtml(newAddress.countryId);
				/** @type {Boolean} */
				var l = customer.isLoggedIn();
				/** @type {String} */
				var url = ub.createUrl(
					df.s.t('/dfe-klarna/%s/html', l?'mine':':quoteId'), l?{}:{quoteId: q.getQuoteId()}
				);
				df.o.merge({cartId: q.getQuoteId(), billingAddress: q.billingAddress(), paymentMethod: null},
					l?{}:{email: q.guestEmail}
				);
			}
		});
		return this;
	},
});});
