<?php
/**
 * Magento
 *
 * @author    Meigeeteam http://www.meaigeeteam.com <nick@meaigeeteam.com>
 * @copyright Copyright (C) 2010 - 2012 Meigeeteam
 *
 */
class Meigee_Meigeewidgets_Block_FeaturedProducts
extends Mage_Catalog_Block_Product_List
implements Mage_Widget_Block_Interface
{
    protected $products;

    protected function _construct() {
        parent::_construct();
    }
	protected function _toHtml() {
        return parent::_toHtml();  
    }

    protected function catId()
    {
        $cat = explode("/", $this->getData('featured_category'));     
        return $cat[1];
    }
    public function catName () {
        return Mage::getModel('catalog/category')->load($this->catId());
    }

    public function getMyCollection () {
        $this->products = Mage::getResourceModel('catalog/product_collection')
            ->addAttributeToSelect(array('name', 'price', 'small_image', 'short_description'), 'inner')
            ->addAttributeToSelect('special_price')
            ->addAttributeToSelect('status')
            ->addCategoryFilter(Mage::getModel('catalog/category')->load($this->catId()));
        return $this->products;
    }

    

}
