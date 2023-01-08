<?php
/**
 * Class Wishlist
 *
 * PHP version 7 & 8
 *
 * @category Cube
 * @package  Cube_ProductInquiry

 */
namespace Cube\ProductInquiry\Plugin\Wishlist\CustomerData;

/**

 */
class Wishlist extends \Magento\Wishlist\CustomerData\Wishlist
{
    /**
     * @var \Cube\ProductInquiry\Helper\Data
     */
    private $helperData;

    /**
     * Wishlist constructor.
     *
     * @param \Magento\Wishlist\Helper\Data $wishlistHelper
     * @param \Magento\Wishlist\Block\Customer\Sidebar $block
     * @param \Magento\Catalog\Helper\ImageFactory $imageHelperFactory
     * @param \Magento\Framework\App\ViewInterface $view
     * @param \Cube\ProductInquiry\Helper\Data $helperData
     * @param \Magento\Catalog\Model\Product\Configuration\Item\ItemResolverInterface|null $itemResolver
     */
    public function __construct(
        \Magento\Wishlist\Helper\Data $wishlistHelper,
        \Magento\Wishlist\Block\Customer\Sidebar $block,
        \Magento\Catalog\Helper\ImageFactory $imageHelperFactory,
        \Magento\Framework\App\ViewInterface $view,
        \Cube\ProductInquiry\Helper\Data $helperData,
        \Magento\Catalog\Model\Product\Configuration\Item\ItemResolverInterface $itemResolver = null
    ) {
        $this->helperData = $helperData;
        return parent::__construct($wishlistHelper, $block, $imageHelperFactory, $view, $itemResolver);
    }

    /**
     * Retrieve wishlist item data
     *
     * @param \Magento\Wishlist\Model\Item $wishlistItem
     * @return array
     */
    protected function getItemData(\Magento\Wishlist\Model\Item $wishlistItem)
    {
        $getItemDataArray = parent::getItemData($wishlistItem);

        $productId = $wishlistItem->getProduct()->getId();
        $disclosePrice = $this->helperData->getDisclosePrice($productId);
        $allowAddToCart = $this->helperData->getAllowAddtocart($productId);

        $productInquiryCheckArray = [
            'allow_add_to_cart' => $allowAddToCart,
            'disclose_price' => $disclosePrice
        ];

        return array_merge($getItemDataArray, $productInquiryCheckArray);
    }
}
