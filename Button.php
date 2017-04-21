<?php
namespace Dfe\Klarna;
use Magento\Catalog\Block\ShortcutInterface as IShortcut;
use Magento\Framework\View\Element\Template as _P;
/**
 * 2017-04-21
 * @final Unable to use the PHP «final» keyword here because of the M2 code generation.
 * @used-by \Dfe\Klarna\Observer\ShortcutButtonsContainer::execute()
 * We are forced inherit from @see \Magento\Framework\View\Element\Template
 * because of the @see \Magento\Catalog\Block\ShortcutButtons::addShortcut() method signature:
 *		public function addShortcut(Template $block)
 *		{
 *			if ($block instanceof ShortcutInterface) {
 *				$this->_shortcuts[] = $block;
 *			}
 *		}
 * https://github.com/magento/magento2/blob/2.1.6/app/code/Magento/Catalog/Block/ShortcutButtons.php#L53-L64
 */
class Button extends _P implements IShortcut {
	/**
	 * 2017-04-21
	 * @final Unable to use the PHP «final» keyword here because of the M2 code generation.
	 * @override
	 * @see IShortcut::getAlias()
	 * @used-by \Magento\Catalog\Block\ShortcutButtons::_toHtml()
	 *		foreach ($this->_shortcuts as $shortcut) {
	 *			$this->setChild($shortcut->getAlias(), $shortcut);
	 *		}
	 * https://github.com/magento/magento2/blob/2.1.6/app/code/Magento/Catalog/Block/ShortcutButtons.php#L91-L93
	 */
	function getAlias() {return __CLASS__;}

	/**
	 * 2017-04-21
	 * @override
	 * @see _P::_toHtml()
	 * @used-by \Magento\Framework\View\Element\AbstractBlock::toHtml()
	 * @return string                                
	 */
	final protected function _toHtml() {return df_cc_n(
		/*df_tag('a',
			['class' => 'dfe-klarna-button'] + df_widget($this, 'button', [])
			,'Check out with Klarna'
		) */
		df_div([
			'class' => 'klarna-widget klarna-part-payment'
			,'data-eid' => dfps($this)->merchantID()
			,'data-locale' => 'sv_se'
			,'data-price' => '1201.34'
			,'data-layout' => 'pale-v2'
			,'data-invoice-fee' => '0.95'
			,'style' => 'width:210px; height:80px'
		])
		,df_link_inline(df_asset_name('button', $this, 'css'))
		,df_js_inline_r('https://cdn.klarna.com/1.0/code/client/all.js')
	);}
}