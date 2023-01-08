<?php
/**
 * Class ProductInquiry
 *
 * PHP version 7 & 8
 *
 * @category Cube
 * @package  Cube_ProductInquiry

 */
namespace Cube\ProductInquiry\Model\ResourceModel;

/**

 */
class ProductInquiry extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Define Maintable and primarykey
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('cube_product_inquiry', 'entity_id');
    }
}
