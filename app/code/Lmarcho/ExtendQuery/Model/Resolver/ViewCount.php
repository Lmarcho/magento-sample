<?php

namespace Lmarcho\ExtendQuery\Model\Resolver;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class ViewCount implements \Magento\Framework\GraphQl\Query\ResolverInterface
{
    public function resolve(
        Field       $field,
                    $context,
        ResolveInfo $info,
        array       $value = null,
        array       $args = null
    )
    {
        $product = $value['model'];
        $objectManager = ObjectManager::getInstance();
        $_product = $objectManager->get('Magento\Catalog\Model\Product')->load($product->getId());
        $view_count = $_product->getData('view_count') + 1;
        $_product->setViewCount($view_count)->save();
        return $view_count;
    }
}
