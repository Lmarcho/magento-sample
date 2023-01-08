<?php
/**
 * Class Collection
 *
 * PHP version 7 & 8
 *
 * @category Cube
 * @package  Cube_ProductInquiry

 */
namespace Cube\ProductInquiry\Model\ResourceModel\ProductInquiry;

/**

 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';
    /**
     * @var string
     */
    protected $_eventPrefix = 'cube_product_inquiry_post_collection';
    /**
     * @var string
     */
    protected $_eventObject = 'product_inquiry_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Cube\ProductInquiry\Model\ProductInquiry::class,
            \Cube\ProductInquiry\Model\ResourceModel\ProductInquiry::class
        );
    }
}
