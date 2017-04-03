// 2016-12-17
define([
	'df', 'df-lodash', 'Df_Core/my/redirectWithPost', 'Df_Payment/custom', 'jquery'
], function(df, _, redirectWithPost, parent, $) {'use strict'; return parent.extend({
	defaults: {
		df: {
			test: {showBackendTitle: false},
			// 2016-12-17
			// @used-by Df_Payment/main
			// https://github.com/mage2pro/core/blob/2.4.21/Payment/view/frontend/web/template/main.html#L36-L38
			formTemplate: 'Dfe_Klarna/form'
		}
	}
	,klHtml: function() {return 'ПРЕВЕД, МЕДВЕД!';}
});});
