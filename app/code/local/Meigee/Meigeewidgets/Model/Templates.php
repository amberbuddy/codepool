<?php 
/**
 * Magento
 *
 * @author    Meigeeteam http://www.meaigeeteam.com <nick@meaigeeteam.com>
 * @copyright Copyright (C) 2010 - 2012 Meigeeteam
 *
 */
class Meigee_Meigeewidgets_Model_Templates
{
    public function toOptionArray()
    {
        return array(
            array('value'=>'meigee/meigeewidgets/grid.phtml', 'label'=>'Grid'),
            array('value'=>'meigee/meigeewidgets/list.phtml', 'label'=>'List'),
            array('value'=>'meigee/meigeewidgets/slider.phtml', 'label'=>'Slider')
        );
    }

}