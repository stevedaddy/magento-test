<?php
class Atwix_Cmsattr_Model_Products extends Mage_Catalog_Model_Product
{
    public function getItemsCollection($valueId,$podsProductType,$product_id)
    {

        //uses $valueId to load dif related product_type
        $collection = $this->getCollection();

        if(!$valueId){
            $collection
                ->addAttributeToSelect('*')
                ->addAttributeToFilter('pods_product_type', array('eq' => $podsProductType))
                ->getSelect()->limit(5);
        }
        else{
            $collection
                ->addAttributeToSelect('*')
                ->addAttributeToFilter('product_type', array('eq' => $valueId))
                ->getSelect()->limit(5);
        }
        //filter featured product from being displayed in its own cross sells
        $collection
            ->addAttributeToSelect('entity_id')
            ->addAttributeToFilter('entity_id', array('neq' => $product_id));

        Mage::getSingleton('cataloginventory/stock')->addInStockFilterToCollection($collection);

       echo 'current id: ' . $product_id;

        return $collection;
    }
}