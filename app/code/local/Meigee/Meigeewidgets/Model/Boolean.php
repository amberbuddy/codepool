<?php class Meigee_Meigeewidgets_Model_Boolean
{
    public function toOptionArray()
    {
        return array(
            array('value'=>'1', 'label'=>Mage::helper('meigeewidgets')->__('True')),
            array('value'=>'0', 'label'=>Mage::helper('meigeewidgets')->__('False'))
        );
    }

}