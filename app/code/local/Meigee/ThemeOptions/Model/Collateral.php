<?php 
/**
 * Magento
 *
 * @author    Meigeeteam http://www.meaigeeteam.com <nick@meaigeeteam.com>
 * @copyright Copyright (C) 2010 - 2012 Meigeeteam
 *
 */
class Meigee_ThemeOptions_Model_Collateral
{
    public function toOptionArray()
    {
        return array(
            array('value'=>'collateral_list', 'label'=>Mage::helper('ThemeOptions')->__('Simple List')),
            array('value'=>'collateral_tabs', 'label'=>Mage::helper('ThemeOptions')->__('Tabs')),
            array('value'=>'collateral_accordion', 'label'=>Mage::helper('ThemeOptions')->__('Accordion'))          
        );
    }

}