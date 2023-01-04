<?php
# 2017-02-04
namespace Dfe\Klarna\Api\Checkout\V2\Charge;
final class AddDiscount extends Part {
	/**
	 * 2017-02-03
	 * @used-by \Dfe\Klarna\Api\Checkout\V2\Charge::kl_order_lines()
	 * @param array(array(string => string|int)) $items
	 * @return array(array(string => string|int))
	 */
	function p(array $items):array {
		/** @var int $total */
		/**
		 * 2017-02-03
		 * Пользуемся тем, что «discount_rate» для элементов мы не заполняли,
		 * и поэтому можем сейчас игнорировать.
		 * @see olProducts()
		 * @see olShipping()
		 */
		$totalK = array_sum(array_map(function(array $i) {return
			$i['quantity'] * $i['unit_price'];
		}, $items)); /** @var int $totalK */
		/** @var int $totalM */
		$totalM = $this->amount($this->oq()->getGrandTotal());
		# 2017-02-03 При этом мы сознательно идём на то, что скидка может оказаться положительным числом, т.е. наценкой
		$discount = $totalM - $totalK; /** @var int $discount */
		return !$discount ? $items : array_merge($items, [[
			/**
			 * 2017-01-26
			 * «Name, usually a short description»
			 * Required: yes.
			 * Type: string.
			 */
			'name' => 'Discount'
			/**
			 * 2017-01-26
			 * «Quantity»
			 * Required: yes.
			 * Type: integer.
			 *
			 * 2017-01-31
			 * Используем @used intval(), потому что
			 * @uses \Magento\Sales\Model\Order\Item::getQtyOrdered() возвращает вещественное число,
			 * а не целое, а передача в Klarna вещественного числа приводит к сбою «Bad format».
			 */
			,'quantity' => 1
			/**
			 * 2017-01-26
			 * «Reference, usually the article number»
			 * Required: yes.
			 * Type: string.
			 */
			,'reference' => 'discount'
			/**
			 * 2017-01-26
			 * «Percentage of tax rate, multiplied by 100 and provided as an integer.
			 * I.e. 13.57% should be sent as 1357.»
			 * Required: yes.
			 * Type: integer.
			 */
			,'tax_rate' => 0
			/**
			 * 2017-01-26
			 * «Type. `physical` by default, alternatively `discount`, `shipping_fee`»
			 * Required: no.
			 * Type: string.
			 *
			 * 2017-02-01
			 * Вот для передачи скидок мы должны использовать значение «discount»,
			 * а для передачи стоимости доставки — значение «shipping_fee».
			 */
			,'type' => 'discount'
			/**
			 * 2017-01-26
			 * «Unit price in cents, including tax»
			 * Required: yes.
			 * Type: integer.
			 *
			 * 2017-02-01
			 * Замечание №1
			 * Нам тут, согласно спецификации Klarna,
			 * нужна цена именно с налогом, поэтому передаём в df_oqi_price() вторым параметром true.
			 *
			 * Замечание №2
			 * «unit_price» — это стоимость именно единицы товара, а не стоимость позиции заказа.
			 * Проверил это опытным путём, например:
			 *   {
			 *       <...>
			 *       "quantity": 2,
			 *       "total_price_excluding_tax": 121892,
			 *       "total_price_including_tax": 121892,
			 *       "unit_price": 60946
			 *		<...>
			 *   }
			 * @uses df_oqi_price() как раз и возвращает стоимость одной единицы товара.
			 *
			 * Замечание №3
			 * Тестовый заказ №376 у нас в шведских кронах.
			 * 10 шведских крон стоят примерно 1 евро.
			 *
			 * 2017-02-02
			 * Замечание №1
			 * Метод @uses \Magento\Sales\Model\Order::getDiscountAmount()
			 * возвращает неположительное значение (отрицательное или 0):
			 * именно неположительным нам и нужно передавать его в Klarna.
			 *
			 * Замечание №2
			 * @todo Реализация $this->amount($this->o()->getDiscountAmount()) некорректна
			 * при ненулевом налогообложении!
			 * В Magento администратор настраивает, учитывать ли скидки в налогооблагаемой базе:
			 * «Sales» → «Tax» → «Calculation Settings»:
			 *
			 * 1) «Apply Customer Tax»: «Before Discount» / «After Discount»
			 * How is the «Apply Customer Tax» («Before Discount» / «After Discount») option handled?
			 * https://mage2.pro/t/2601
			 *
			 * 2) «Apply Discount On Prices»: «Excluding Tax» / «Including Tax»
			 * How is the «Apply Discount On Prices» («Excluding Tax» / «Including Tax») option handled?
			 * https://mage2.pro/t/2602
			 *
			 * В Klarna же происходит так:
			 *	"cart": {
			 *		"items": [
			 *			{
			 *				"quantity": 1,
			 *				"tax_rate": 2500,
			 *				"total_price_excluding_tax": 60946,
			 *				"total_price_including_tax": 76183,
			 *				"total_tax_amount": 15237,
			 *				"unit_price": 76183
			 *			},
			 *			{
			 *				"quantity": 2,
			 *				"tax_rate": 2500,
			 *				"total_price_excluding_tax": 93634,
			 *				"total_price_including_tax": 117042,
			 *				"total_tax_amount": 23408,
			 *				"unit_price": 58521
			 *			},
			 *			{
			 *				"quantity": 1,
			 *				"tax_rate": 2500,
			 *				"total_price_excluding_tax": 46817,
			 *				"total_price_including_tax": 58521,
			 *				"total_tax_amount": 11704,
			 *				"unit_price": 58521
			 *			},
			 *			{
			 *				"quantity": 3,
			 *				"tax_rate": 2500,
			 *				"total_price_excluding_tax": 188378,
			 *				"total_price_including_tax": 235473,
			 *				"total_tax_amount": 47095,
			 *				"unit_price": 78491
			 *			},
			 *			{
			 *				"type": "discount",
			 *				"quantity": 1,
			 *				"tax_rate": 0,
			 *				"total_price_excluding_tax": -27284,
			 *				"total_price_including_tax": -27284,
			 *				"total_tax_amount": 0,
			 *				"unit_price": -27284
			 *			},
			 *			{
			 * 				"type": "shipping_fee",
			 *				"quantity": 1,
			 *				"tax_rate": 0,
			 *				"total_price_excluding_tax": 17545,
			 *				"total_price_including_tax": 17545,
			 *				"total_tax_amount": 0,
			 *				"unit_price": 17545
			 *			}
			 *		],
			 *		"total_price_excluding_tax": 380036,
			 *		"total_tax_amount": 97444,
			 *		"total_price_including_tax": 477480
			 *	},
			 *
			 * Позиции заказа (с налогом): 76183 + 117042 + 58521 + 235473 = 487219
			 * Доставка (с нулевым налогом): 17545
			 * Скидка: -27284
			 * Налог (25% на товары): 97444
			 * Итог: 477480
			 * Т.е. Klarna просто складывает переданные нами цены.
			 *
			 * Magento же, в зависимости от упомянутых выше настроек, может считать хитрее:
			 *
			 * Позиции заказа
			 * 1) 76183 (с налогом), 60946 (без налога)
			 * 2) 117042 (с налогом), 93634 (без налога)
			 * 3) 58521 (с налогом), 46817 (без налога)
			 * 4) 235474 (с налогом), 188379 (без налога)
			 * Стоимость всех позиций: 487220  (с налогом), 389776 (без налога)
			 * Доставка (с нулевым налогом): 17545
			 * Скидка: -27284
			 * Налог (25% на товары): 90623
			 * Итог: 470660
			 *
			 * Как видно, в данном примере Magento иначе посчитала налог на товары, нежели Klarna.
			 * Разница в налогах: 97444 (Klarna) - 90623 (Magento) = 6821
			 * 6821 — это 25% от величины скидки (27284).
			 * Получается, что Klarna начислила БОЛЬШИЙ налог на товары,
			 * потому что сочла налогооблагаемой базой стоимость товаров ДО вычета скидки.
			 *
			 * Magento же сочла налогооблагаемой базой стоимость товаров ПОСЛЕ вычета скидки.
			 * Причём, как я писал выше, в Magento такое поведение настраивается администратором.
			 *
			 * Как же должен вести себя наш модуль?
			 * 1) Если администратор настроил Magento считать налогооблагаемой базой
			 * стоимость товаров ДО вычета скидки («Apply Customer Tax» => «After Discount»)
			 * то мы можем использовать для этой ситуации наш текущий алгоритм:
			 * 'unit_price' => $this->amount($this->o()->getDiscountAmount())
			 *
			 * 2) Если администратор настроил Magento считать налогооблагаемой базой
			 * стоимость товаров ПОСЛЕ вычета скидки («Apply Customer Tax» => «Before Discount»),
			 * то нам нужно скорректировать наш алгоритм:
			 * уменьшить передаваемую в Klarna скидку на величину товарного налога,
			 * как бы применённого к этой скидке.
			 * Вернёмся к примеру выше:
			 * Скидка в Magento равна -27284.
			 * Нам нужно:
			 * 2.1) Посчитать итог по алгоритму Klarna (477480).
			 * 2.2) Вычесть из него готовый (уже хранящийся в заказе) итог Magento (470660)
			 * 477480 - 470660 = 6821.
			 * 2.3) Уменьшить скидку Magento на данную величину.
			 * Причём, учитывая, что скидка — значение отрицательное,
			 * то уменьшение в данном случае означает СЛОЖЕНИЕ: -27284 + 6821.
			 * При на странице оформления заказа в Klarna покупатель увидит другое значение скидки,
			 * нежели в Magento, но итоговая стоимость заказа будет той же самой.
			 *
			 * Замечание №3
			 * @todo Аналогичным образом некорректной, видимо, является и реализация «unit_price»
			 * в @see olShipping(): $this->amount($this->o()->getShippingAmount())
			 * В Magento администратор настраивает, учитывать ли стоимость доставки
			 * в налогооблагаемой базе:
			 * «Sales» → «Tax» → «Calculation Settings» → «Shipping Prices»:
			 * «Excluding Tax» / «Including Tax»
			 */
			,'unit_price' => $discount
		]]);
	}
}