<?php
class Atwix_Cmsattr_Block_List extends Mage_Catalog_Block_Product_Abstract
{
    protected $_itemCollection = null;

    public function getItems()
    {
        $_product = $this->getProduct();
        $productType = $_product->getProduct_type();
        $product_id = $_product->getId();

        if (is_null($this->_itemCollection)) {
            $this->_itemCollection = Mage::getModel('atwix_cmsattr/products')->getItemsCollection($productType);
        }

        echo '<br>current product id: ' . $product_id;
        echo '<br>current product_type: ' . $productType;
        return $this->_itemCollection;
    }
}