// 2016-12-17
define([
	'df', 'df-lodash', 'Df_Checkout/api', 'Df_Payment/billingAddressChange', 'Df_Payment/custom', 'jquery', 'ko'
	,'Magento_Checkout/js/model/quote'
	,'Magento_Customer/js/model/customer'
	,'Magento_Checkout/js/model/url-builder'
], function(df, _, api, baChange, parent, $, ko, q, customer, ub) {'use strict';
/** 2017-09-06 @uses Class::extend() https://github.com/magento/magento2/blob/2.2.0-rc2.3/app/code/Magento/Ui/view/base/web/js/lib/core/class.js#L106-L140 */
return parent.extend({
	// 2016-12-17
	// @used-by Df_Payment/main
	// https://github.com/mage2pro/core/blob/2.4.21/Payment/view/frontend/web/template/main.html#L36-L38	
	defaults: {df: {formTemplate: 'Dfe_Klarna/form'}},
	/**
	 * 2017-04-04
	 * @override
	 * @see Df_Payment/card::initialize()
	 * https://github.com/mage2pro/core/blob/2.4.21/Payment/view/frontend/web/card.js#L77-L110
	 * @returns {exports}
	*/
	initialize: function() {
		this._super();
		this.klHtml = ko.observable(this.config('html'));
		baChange(this, function(newAddress) {if (newAddress.countryId) {
			// 2017-04-04
			// The M2 client part does not notify the server part about the billing address change.
			// So we need to pass the chosen country ID to the server part.
			//console.log(newAddress.countryId);
			//_this.klHtml(newAddress.countryId);
			/** @type {Boolean} */ var l = customer.isLoggedIn();
			$.when(api(this,
				// 2017-04-05
				// Для анонимных покупателей q.getQuoteId() — это строка вида
				// «63b25f081bfb8e4594725d8a58b012f7».
				ub.createUrl(df.s.t('/dfe-klarna/%s/html', l ? 'mine' : q.getQuoteId()), {})
				,_.assign({ba: q.billingAddress(), qp: this.getData()}, l ? {} : {email: q.guestEmail})
			))
				.fail(function() {debugger;})
				.done($.proxy(function(json) {
					// 2017-04-05 Отныне json у нас всегда строка: @see dfw_encode().
					/** @type {Object} */
					var d = !json ? {} : $.parseJSON(json);
					this.klHtml(d['html']);
				}, this))
			;
		}}, false);
		return this;
	}
});});