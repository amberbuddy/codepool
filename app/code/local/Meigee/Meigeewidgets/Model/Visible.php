<?php class Meigee_Meigeewidgets_Model_Visible
{
    public function toOptionArray()
    {
        return array(
            array('value'=>'1', 'label'=>Mage::helper('meigeewidgets')->__('1')),
            array('value'=>'2', 'label'=>Mage::helper('meigeewidgets')->__('2')),
            array('value'=>'3', 'label'=>Mage::helper('meigeewidgets')->__('3')),
            array('value'=>'4', 'label'=>Mage::helper('meigeewidgets')->__('4'))
        );
    }

}