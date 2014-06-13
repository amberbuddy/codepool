<?php 
/**
 * Magento
 *
 * @author    Meigeeteam http://www.meaigeeteam.com <nick@meaigeeteam.com>
 * @copyright Copyright (C) 2010 - 2012 Meigeeteam
 *
 */
class Meigee_ThemeOptions_Model_Languageswitcher
{
    public function toOptionArray()
    {
        return array(
            array('value'=>'language_select', 'label'=>Mage::helper('ThemeOptions')->__('Select Box')),
            array('value'=>'language_flags', 'label'=>Mage::helper('ThemeOptions')->__('Flags'))          
        );
    }

}