<?php 
/**
 * Magento
 *
 * @author    Meigeeteam http://www.meaigeeteam.com <nick@meaigeeteam.com>
 * @copyright Copyright (C) 2010 - 2012 Meigeeteam
 *
 */
class Meigee_ThemeOptions_Model_Cssgenerate extends Mage_Core_Model_Config_Data
{
    private $baseColors;
    private $designNodes = array();
    private $dirPath;
    private $filePath;

    private function setBaseColors () {
        $this->baseColors = Mage::getStoreConfig('meigee_design/base');
    }

    private function setLocation () {
        $this->dirPath = Mage::getBaseDir('skin') . '/frontend/meigeetheme/default/css/';
        $this->filePath = $this->dirPath . 'skin.css';
    }

    public function _afterSave()
    {

        $this->setBaseColors();
        $this->designNodes[] = Mage::getStoreConfig('meigee_design/header');


        $css = "/**
* These styles is generated automaticaly. Please Do no edit it directly all changes will be lost.
* Skin
*/";

        $css .= '/*======Site Bg=======*/
.content-wrapper{background-color:#' . $this->baseColors['sitebg'] . ';}



/*======Skin Color #1=======*/ /* Red */
.catalog-product-view .box-reviews .form-add h3 span,
.products-grid  button span span,
.block-poll .block-subtitle,
.block-list li.item .product-name a:before,
#categories-accordion li.level-top.opened a.level-top,
#footer .footer-block a.more,
#footer .footer-block ul.tweets li a,
.product-name a:hover,
#footer .footer-block h4,
.price{color:#' . $this->baseColors['maincolor'] . ';}


.catalog-product-view .box-reviews .data-table thead,
.meigee-tabs li.active a,
.meigee-tabs li.active a:hover,
.product-view .product-shop .product-type-block .email-friend > span,
.product-view .product-options-bottom .email-friend > span,
.toolbar-bottom .pager .pages ol li.current span,
.link-compare > span,
.link-wishlist > span,
.pager .pages li a.i-previous,
.pager .pages li a.i-next,
.sorter .sort-by a,
.block-wishlist .prev:hover,
.block-wishlist .next:hover,
aside.sidebar .actions a,
.btn-remove:hover,
.block-layered-nav dl#layered_navigation_accordion dt.closed .btn-nav,
#categories-accordion li.level-top.parent.closed .btn-cat,
#categories-accordion li.level-top.parent .btn-cat.closed,
#footer .block-subscribe .input-box button:hover > span,
#nav > li.active,
#nav > li.over,
header#header .top-cart .product-box .price-qty,
button.button > span,
header#header .dropdown-links ul,
header#header .dropdown-links .dropdown-links-title,
header#header .links li a.top-link-login,
ul.social-links li a:hover{background-color:#' . $this->baseColors['maincolor'] . ';}



/*======Skin Color #2=======*/ /* Green */
.temp-class-1{color:#' . $this->baseColors['secondcolor'] . ';}


.block-related .prev,
.block-related .next,
.meigee-tabs a:hover,
.product-view .product-shop .product-type-block .email-friend:hover > span,
.product-view .product-options-bottom .email-friend:hover > span,
.my-wishlist input.quantity-decrease,
.my-wishlist input.quantity-increase,
.add-to-cart input.quantity-decrease,
.add-to-cart input.quantity-increase,
.cart-table input.quantity-decrease,
.cart-table input.quantity-increase,
.more-views .prev, 
.more-views .next,
header#header .top-cart .block-title .cart-icon,
.link-compare:hover > span,
.link-wishlist:hover > span,
.pager .pages li a.i-previous:hover,
.pager .pages li a.i-next:hover,
.sorter .sort-by a:hover,
.block-wishlist .prev,
.block-wishlist .next,
.btn-remove,
.block-layered-nav dl#layered_navigation_accordion dt .btn-nav,
#categories-accordion li.level-top.parent .btn-cat,
#footer .footer-main-block .site-container,
header#header .top-cart .block-content button.button:hover > span,
header#header .links li a.top-link-login:hover,
ul.social-links li a{background-color:#' . $this->baseColors['secondcolor'] . ';}';

        foreach ($this->designNodes as $nodes) {
            foreach ($nodes as $className=>$rule) {
                $pieces = explode ('_', $className);
                $trans = array("dot" => ".", "--" => " ");
                $separatedClass = strtr($pieces[0], $trans);


                $css .= $separatedClass . '{' . $pieces[1] . ':' . $rule . ';}';
            }
        }

    	$this->saveData($css);
        Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('ThemeOptions')->__("CSS file with custom styles has been created"));

        return parent::_afterSave();
    }

    private function saveData($data)
    {
        $this->setLocation ();

        try {
	        /*$fh = fopen($file, 'w');
	       	fwrite($fh, $data);
	        fclose($fh);*/

            $fh = new Varien_Io_File(); 
            $fh->setAllowCreateFolders(true); 
            $fh->open(array('path' => $this->dirPath));
            $fh->streamOpen($this->filePath, 'w+'); 
            $fh->streamLock(true); 
            $fh->streamWrite($data); 
            $fh->streamUnlock(); 
            $fh->streamClose(); 
    	}
    	catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('ThemeOptions')->__('Failed creation custom css rules. '.$e->getMessage()));
        }
    }

}