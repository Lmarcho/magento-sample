<?php
namespace Cube\ProductInquiry\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class Inquiry implements ResolverInterface
{
    /**
     * @var DataProvider\Inquiry
     */
    protected $productInquiryDataProvider;

    /**
     * @param DataProvider\Inquiry $productInquiryDataProvider
     */
    public function __construct(
        \Cube\ProductInquiry\Model\Resolver\DataProvider\Inquiry $productInquiryDataProvider
    ) {
        $this->productInquiryDataProvider = $productInquiryDataProvider;
    }

    /**
     * @param Field $field
     * @param $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return array|\Magento\Framework\GraphQl\Query\Resolver\Value|mixed
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        $name = $args['input']['name'];
        $email = $args['input']['email'];
        $telephone = $args['input']['phone'];
        $message = $args['input']['message'];
        $sku = $args['input']['sku'];

        $success_message = $this->productInquiryDataProvider->saveInquiry(
            $name,
            $email,
            $telephone,
            $message,
            $sku,
        );
        return $success_message;
    }
}
