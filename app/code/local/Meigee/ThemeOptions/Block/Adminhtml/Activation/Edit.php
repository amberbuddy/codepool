<?php

class Meigee_ThemeOptions_Block_Adminhtml_Activation_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'themeoptions';
        $this->_controller = 'adminhtml_activation';
         
        $this->_updateButton('save', 'label', Mage::helper('ThemeOptions')->__('Activate'));
    }
 
    public function getHeaderText()
    {
        return Mage::helper('ThemeOptions')->__('Theme Activation');
    }


    


}