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
	 * 2017-04-21 https://developers.klarna.com/en/se/kco-v2/logos
	 * @override
	 * @see _P::_toHtml()
	 * @used-by \Magento\Framework\View\Element\AbstractBlock::toHtml()
	 * @return string                                
	 */
	final protected function _toHtml() {
		$base = 'https://cdn.klarna.com/1.0/';
		// 2017-04-24
		// Другое значение: «blue-black».
		/** @var string $style */
		$style = 'white';
		/** @var bool $textIsBefore */ $textIsBefore = true;
		/** @var string $title */ $title = __('Check out with Klarna');
		/** @var int $width */ $width = 70;
		$contentA = [
			df_tag('span', $textIsBefore ? 'dfBefore' : 'dfAfter', __('Check out with'))
			,df_tag('img', [
				'alt' => $title
				,'src' => "{$base}shared/image/generic/logo/sv_se/basic/$style.png?width=$width"
				,'title' => $title
				,'width' => $width
			])
		];
		return df_cc_n(
			df_tag('a',
				['class' => 'dfe-klarna-button', 'title' => $title] + df_widget($this, 'button', [])
				,implode($textIsBefore ? $contentA : array_reverse($contentA))
			)
			,df_link_inline(df_asset_name('button', $this, 'css'))
			//,df_js_inline_r("{$base}code/client/all.js")
		);
	}
}