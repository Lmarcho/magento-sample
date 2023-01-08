<?php
/**
 * Class Index
 *
 * PHP version 7 & 8
 *
 * @category Cube
 * @package  Cube_ProductInquiry
 */
namespace Cube\ProductInquiry\Controller\Adminhtml\Index;

/**
 */
class Index extends \Magento\Backend\App\Action
{
    /**
     * @var bool|\Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory = false;

    /**
     * Index constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->_resultPageFactory = $resultPageFactory;
    }

    /**
     * Load result page
     *
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Product Inquiries')));

        return $resultPage;
    }
}
