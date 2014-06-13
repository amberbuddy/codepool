<?php
/**
 * Magento
 *
 * @author    Meigeeteam http://www.meaigeeteam.com <nick@meaigeeteam.com>
 * @copyright Copyright (C) 2010 - 2012 Meigeeteam
 *
 */
class Meigee_ThemeOptions_RestoreController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
     $this->loadLayout(array('default'));

         $this->_addLeft($this->getLayout()
                ->createBlock('core/text')
                ->setText('
                    <h5>Predefined pages:</h5>
                    <ul>
                        <li>home</li>
                    </ul><br />
                    <h5>Predefined static blocks:</h5>
                    <ul>
                        <li>cart_banner</li>
                        <li>checkout_banner</li>
                        <li>custom_footer</li>
                        <li>custom_footer_2</li>
                        <li>header_slide_1</li>
                        <li>header_slide_2</li>
                        <li>header_slide_3</li>
                        <li>header_text_box</li>
                        <li>header_wide_slide_1</li>
                        <li>header_wide_slide_2</li>
                        <li>header_wide_slide_3</li>
                        <li>home_page</li>
                        <li>product_custom</li>
                        <li>product_custom_2</li>
                        <li>slider_banners</li>
                        <li>slider_text_box</li>
                        <li>slider_text_box_2</li>
                        <li>social_links</li>
                    </ul><br />
                    <strong style="color:red;">To get more info regarding these blocks please read documentation that comes with this theme.</strong>'));
		$this->_addContent($this->getLayout()->createBlock('themeoptions/adminhtml_restore_edit'));
		$this->renderLayout();


    }

    public function saveAction() {
        if ($data = $this->getRequest()->getPost()) {
        	
        $stores = $this->getRequest()->getParam('stores', array(0));
        $setup_package = $this->getRequest()->getParam('setup_package', 0);
        $this->_clear = $this->getRequest()->getParam('clear_scope', false);
        $setup_pages = $this->getRequest()->getParam('setup_pages', 0);
        $setup_blocks = $this->getRequest()->getParam('setup_blocks', 0);

        if ($this->_clear) {
            if ( !in_array(0, $this->_stores) )
                $stores[] = 0;
        }

        try {
            foreach ($stores as $store) {
                $scope = ($store ? 'stores' : 'default');
                if ($setup_package) {
                    Mage::getConfig()->saveConfig('design/package/name', 'default', $scope, $store);
                }
            }
            $defaults = new Varien_Simplexml_Config();
            $defaults->loadFile(Mage::getBaseDir().'/app/code/local/Meigee/ThemeOptions/etc/config.xml');

            $this->_restoreSettings($defaults->getNode('default/meigee_general')->children(), 'meigee_general');
            $this->_restoreSettings($defaults->getNode('default/meigee_general')->children(), 'meigee_productpage');
            $this->_restoreSettings($defaults->getNode('default/meigee_general')->children(), 'meigee_sidebar');
            $this->_restoreSettings($defaults->getNode('default/meigee_general')->children(), 'meigee_headerslider');

            if ($setup_pages) {
                Mage::getModel('ThemeOptions/restore')->setupPages();
            }

            if ($setup_blocks) {
                Mage::getModel('ThemeOptions/restore')->setupBlocks();
            }

            Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('ThemeOptions')->__('Default settings has been restored. Please clear all the cache cache (System > Cache management)'));
        
        }
        catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('ThemeOptions')->__('An error occurred while restoring theme. '.$e->getMessage()));
        }

        $this->getResponse()->setRedirect($this->getUrl("*/*/"));
        }
    }

    private function _restoreSettings($items, $path)
    {
        $websites = Mage::app()->getWebsites();
        $stores = Mage::app()->getStores();
        foreach ($items as $item) {
            if ($item->hasChildren()) {
                $this->_restoreSettings($item->children(), $path.'/'.$item->getName());
            } else {
                if ($this->_clear) {
                    Mage::getConfig()->deleteConfig($path.'/'.$item->getName());
                    foreach ($websites as $website) {
                        Mage::getConfig()->deleteConfig($path.'/'.$item->getName(), 'websites', $website->getId());
                    }
                    foreach ($stores as $store) {
                        Mage::getConfig()->deleteConfig($path.'/'.$item->getName(), 'stores', $store->getId());
                    }
                }
                foreach ($this->_stores as $store) {
                    $scope = ($store ? 'stores' : 'default');
                    Mage::getConfig()->saveConfig($path.'/'.$item->getName(), (string)$item, $scope, $store);
                }
            }
        }
    }
}