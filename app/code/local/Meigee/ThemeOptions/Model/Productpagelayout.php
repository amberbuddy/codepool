<?php 
/**
 * Magento
 *
 * @author    Meigeeteam http://www.meaigeeteam.com <nick@meaigeeteam.com>
 * @copyright Copyright (C) 2010 - 2012 Meigeeteam
 *
 */
class Meigee_ThemeOptions_Model_Productpagelayout
{
    public function toOptionArray()
    {
        return array(
            array('value'=>'productpage_small', 'label'=>Mage::helper('ThemeOptions')->__('Small')),
            array('value'=>'productpage_medium', 'label'=>Mage::helper('ThemeOptions')->__('Medium')),
            array('value'=>'productpage_large', 'label'=>Mage::helper('ThemeOptions')->__('Large')),
            array('value'=>'productpage_extralarge', 'label'=>Mage::helper('ThemeOptions')->__('Extra large'))
        );
    }

}