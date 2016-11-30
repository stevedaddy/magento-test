<?php
class Atwix_Cmsattr_Block_List extends Mage_Catalog_Block_Product_Abstract
{
    protected $_itemCollection = null;

    public function getItems()
    {
        $_product = $this->getProduct();
        if($_product) {
            $productType = $_product->getProduct_type();
            $podsProductType = $_product->getPods_product_type();
            $product_id = $_product->getId();
        }
        else{
            $productType = '9999';
            $podsProductType = NULL;
            $product_id = '777';
        }
        if (is_null($this->_itemCollection)) {
            $this->_itemCollection = Mage::getModel('atwix_cmsattr/products')->getItemsCollection($productType,$podsProductType,$product_id);
        }

//        echo '<br>current product id: ' . $product_id;
//        echo '<br>current product_type: ' . $productType;
//        echo '<br>current pods_product_type: ' . $podsProductType;

        return $this->_itemCollection;
    }
}