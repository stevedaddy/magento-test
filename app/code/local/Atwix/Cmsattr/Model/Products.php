<?php
class Atwix_Cmsattr_Model_Products extends Mage_Catalog_Model_Product
{
    public function getItemsCollection($valueId)
    {
        $collection = $this->getCollection()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('product_type', array('eq' => $valueId));
        //uses $valueId to load dif related product_type
        Mage::getSingleton('cataloginventory/stock')->addInStockFilterToCollection($collection);

        echo 'current product_type: ' . $valueId;
        return $collection;
    }
}