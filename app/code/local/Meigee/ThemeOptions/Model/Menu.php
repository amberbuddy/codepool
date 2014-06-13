<?php 
/**
 * Magento
 *
 * @author    Meigeeteam http://www.meaigeeteam.com <nick@meaigeeteam.com>
 * @copyright Copyright (C) 2010 - 2012 Meigeeteam
 *
 */
class Meigee_ThemeOptions_Model_Menu
{
    public function toOptionArray()
    {
        return array(
            array('value'=>'menu', 'label'=>Mage::helper('ThemeOptions')->__('Standard')),
            array('value'=>'menu_wide', 'label'=>Mage::helper('ThemeOptions')->__('Wide'))          
        );
    }

}