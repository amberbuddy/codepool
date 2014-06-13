<?php
/**
 * Magento
 *
 * @author    Meigeeteam http://www.meaigeeteam.com <nick@meaigeeteam.com>
 * @copyright Copyright (C) 2010 - 2012 Meigeeteam
 *
 */
class Meigee_ThemeOptions_ActivationController extends Mage_Adminhtml_Controller_Action
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
		$this->_addContent($this->getLayout()->createBlock('themeoptions/adminhtml_activation_edit'));
        $block = $this->getLayout()->createBlock('core/text')->setText('<strong>Note:</strong> Please make sure you have at least 8 products marked as new to display homepage widgets correctly.');
        $this->getLayout()->getBlock('content')->append($block);
		$this->renderLayout();
    }

    public function saveAction() {
        if ($data = $this->getRequest()->getPost()) {
        	
        $stores = $this->getRequest()->getParam('stores', array(0));
        $setup_pages = $this->getRequest()->getParam('setup_pages', 0);
        $setup_blocks = $this->getRequest()->getParam('setup_blocks', 0);

        try {

            foreach ($stores as $store) {
                $scope = ($store ? 'stores' : 'default');

                Mage::getConfig()->saveConfig('design/package/name', 'meigeetheme', $scope, $store);
                //Mage::getConfig()->saveConfig('design/header/logo_src', 'images/logo.png', $scope, $store);
                Mage::getConfig()->saveConfig('design/footer/copyright', 'Meigee &copy; 2013 <a href="http://meigeeteam.com" >Premium Magento Themes</a>', $scope, $store);
    /*
                Mage::getConfig()->saveConfig('meigee_headerslider/coin/slides', 'meigeetheme', $scope, $store);*/
            }

            if ($setup_pages) {
                Mage::getModel('ThemeOptions/activation')->setupPages();
            }

            if ($setup_blocks) {
                Mage::getModel('ThemeOptions/activation')->setupBlocks();
            }

            Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('ThemeOptions')->__('MeigeeTheme has been activated.<br/>
                    Please clear all the cache and then logout and login again to see the theme options block
                '));
        }
        catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('ThemeOptions')->__('An error occurred while activating theme. '.$e->getMessage()));
        }

        $this->getResponse()->setRedirect($this->getUrl("*/*/"));
        }
    }
}