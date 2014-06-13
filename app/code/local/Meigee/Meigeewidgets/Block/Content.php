<?php

class Meigee_Meigeewidgets_Block_Content
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

    public function getTabsContent () {

        $data = array();
        foreach ($this->getData() as $key => $value) {
            $data[$key] = $value; 
        }
       /* $tabsContent = array();
            if (!empty($this->getData('tab_title'))): $tabsContent[$this->getData('tab_title')] = $this->getData('tab_content'); endif;
            /*if (!empty($this->getData('tab_title_2')) && !empty($this->getData('tab_content_2'))): $tabsContent[$this->getData('tab_title_2')] = $this->getData('tab_content_2'); endif;
            if (!empty($this->getData('tab_title_3')) && !empty($this->getData('tab_content_3'))): $tabsContent[$this->getData('tab_title_3')] = $this->getData('tab_content_3'); endif;
            if (!empty($this->getData('tab_title_4')) && !empty($this->getData('tab_content_4'))): $tabsContent[$this->getData('tab_title_4')] = $this->getData('tab_content_4'); endif;
            if (!empty($this->getData('tab_title_5')) && !empty($this->getData('tab_content_5'))): $tabsContent[$this->getData('tab_title_5')] = $this->getData('tab_content_5'); endif;*/
        

        return $data;
    }

    

}
