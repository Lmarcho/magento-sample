<?php
/**
 * Class ProductInquiry
 *
 * PHP version 7 & 8
 *
 * @category Cube
 * @package  Cube_ProductInquiry

 */
namespace Cube\ProductInquiry\Model;

/**

 */
class ProductInquiry extends \Magento\Framework\Model\AbstractModel
{
    public const CACHE_TAG = 'cube_product_inquiry_post';

    /**
     * @var string
     */
    protected $_cacheTag = 'cube_product_inquiry_post';
    /**
     * @var string
     */
    protected $_eventPrefix = 'cube_product_inquiry_post';

    /**
     * ProductInquiry Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Cube\ProductInquiry\Model\ResourceModel\ProductInquiry::class);
    }
}
