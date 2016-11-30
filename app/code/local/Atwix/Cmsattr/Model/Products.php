<?php
class Atwix_Cmsattr_Model_Products extends Mage_Catalog_Model_Product
{

    public function getItemsCollection($valueId,$podsProductType,$product_id)
    {
        //uses $valueId to load dif related product_type
        $collection = $this->getCollection();
        if(!$valueId){
            // 4 = small machine
            // 19 = small pods

            // 3 = large machine
            // 20= large pods

            // 5 = expresso machine
            // 18 = expresso pods

            //turn this into a loop, get rid of it being twice,
            // this is hacky code for sure, must be fixed
            switch ($podsProductType) {
                case '18':
                    $prodId = '5';
                    break;
                case '19':
                    $prodId = '4';
                    break;
                case '20':
                    $prodId = '3';
                    break;
                default:
                    $prodId = '4';
            }
            $collection
                ->addAttributeToSelect('*')
                ->addAttributeToFilter('product_type', array('eq' => $prodId))
                ->getSelect()->limit(5);
        }

        else{
            //turn this into a loop, get rid of it being twice,
            // this is hacky code for sure, must be fixed
            switch ($valueId) {
                case '5':
                    $podId = '18';
                    $showFilter = array('eq' => $podId);
                    $groupBy = 'coffee_flavor';
                    $collection
                        ->addAttributeToSelect('*')
                        ->addAttributeToFilter('pods_product_type', $showFilter)
                        ->addAttributeToFilter('coffee_flavor', array('notnull' => true));
                    break;
                case '4':
                    $podId = '19';
                    $showFilter = array('eq' => $podId);
                    $groupBy = 'coffee_flavor';
                    $collection
                        ->addAttributeToSelect('*')
                        ->addAttributeToFilter('pods_product_type', $showFilter)
                        ->addAttributeToFilter('coffee_flavor', array('notnull' => true));
                    break;
                case '3':
                    $podId = '20';
                    $showFilter = array('eq' => $podId);
                    $groupBy = 'coffee_flavor';
                    $collection
                        ->addAttributeToSelect('*')
                        ->addAttributeToFilter('pods_product_type', $showFilter)
                        ->addAttributeToFilter('coffee_flavor', array('notnull' => true));
                    break;
                case '9999':
                    $showFilter = array('notnull' => true);
                    $groupBy = 'entity_id';
                    break;
                default:
                    $podId = '19';
                    $showFilter = array('eq' => $podId);
                    $groupBy = 'coffee_flavor';
                    $collection
                        ->addAttributeToSelect('*')
                        ->addAttributeToFilter('pods_product_type', $showFilter)
                        ->addAttributeToFilter('coffee_flavor', array('notnull' => true));
            }
            $collection
                ->addAttributeToSelect('*')
//                ->addAttributeToFilter('pods_product_type', $showFilter)
//                ->addAttributeToFilter('coffee_flavor', array('notnull' => true))
                //Group by flavor after making sure they're all assigned a flavor,
                //so it just cuts out the more expensive ones
                ->groupByAttribute($groupBy)
              //  ->addAttributeToFilter('price', array('lt' => 10))
                ->setOrder('price', 'ASC')
                ->getSelect();
        }
        //filter featured product from being displayed in its own cross sells
//        $collection
//            ->addAttributeToSelect('entity_id')
//            ->addAttributeToFilter('entity_id', array('neq' => $product_id));

        Mage::getSingleton('cataloginventory/stock')->addInStockFilterToCollection($collection);

//        echo 'current pods_product_type: ' . $podsProductType;
//        echo '<br>current product_type: ' . $valueId;
//        echo '<br>current id: ' . $product_id;

        return $collection;
    }
}