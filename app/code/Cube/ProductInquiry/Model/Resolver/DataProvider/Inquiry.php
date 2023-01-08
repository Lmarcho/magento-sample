<?php

namespace Cube\ProductInquiry\Model\Resolver\DataProvider;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Store\Model\ScopeInterface;

class Inquiry
{
    /**
     * @var DataPersistorInterface
     */
    protected $_dataPersistor;
    /**
     * @var \Cube\ProductInquiry\Model\ProductInquiryFactory
     */
    protected $_inquiryFactory;
    /**
     * @var \Magento\Framework\Translate\Inline\StateInterface
     */
    protected $_inlineTranslation;
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;
    /**
     * @var \Magento\Framework\Escaper
     */
    protected $_escaper;
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;
    /**
     * @var \Magento\Framework\Mail\Template\TransportBuilder
     */
    protected $_transportBuilder;

    /**
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Cube\ProductInquiry\Model\ProductInquiryFactory   $inquiryFactory,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Store\Model\StoreManagerInterface         $storeManager,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Escaper                         $escaper,
        \Magento\Framework\Mail\Template\TransportBuilder  $transportBuilder,
        DataPersistorInterface                             $dataPersistor
    ) {
        $this->_escaper = $escaper;
        $this->_storeManager = $storeManager;
        $this->_inlineTranslation = $inlineTranslation;
        $this->_inquiryFactory = $inquiryFactory;
        $this->_dataPersistor = $dataPersistor;
        $this->_scopeConfig = $scopeConfig;
        $this->_transportBuilder = $transportBuilder;
    }

    /**
     * @param $name
     * @param $email
     * @param $telephone
     * @param $message
     * @param $sku
     * @return array
     */
    public function saveInquiry($name, $email, $telephone, $message, $sku)
    {
        $thanks_message = [];
        try {
            $error = false;
            if (!\Zend_Validate::is(trim((string)$name), 'NotEmpty')) {
                $error = true;
            }
            if (!\Zend_Validate::is(trim((string)$message), 'NotEmpty')) {
                $error = true;
            }
            if (!\Zend_Validate::is(trim((string)$email), 'EmailAddress')) {
                $error = true;
            }
            if (!\Zend_Validate::is(trim((string)$sku), 'NotEmpty')) {
                $error = true;
            }
            if ($error) {
                $this->_inlineTranslation->resume();
                $message = "0::" . __('We can\'t process your request right now.');
            }

            $inquiry = $this->_inquiryFactory->create();
            $inquiry->setName($name);
            $inquiry->setPhone($telephone);
            $inquiry->setEmail($email);
            $inquiry->setDescription($message);
            $inquiry->setSku($sku);
            $inquiry->save();

            $this->_inlineTranslation->resume();

            $message = "1::" . __('Thanks for contacting us with your comments. We\'ll respond to you very soon.');

            $this->_dataPersistor->clear('cube_product_inquiry');
        } catch (\Exception $e) {
            $this->_inlineTranslation->resume();
            $message = "0::" . __('We can\'t process your request right now.');
        }

        $this->sendEmail($email, $name, $telephone, $message, $sku);

        $thanks_message['success_message'] = $message;
        return $thanks_message;
    }

    /**
     *
     * @param $email
     * @param $name
     * @param $telephone
     * @param $message
     * @param $sku
     * @return void
     */
    public function sendEmail($email, $name, $telephone, $message, $sku)
    {
        try {
            $store = $this->_storeManager->getStore()->getId();

            $getSenderEmail = "ident_" . $this->_scopeConfig->
                getValue('product_inquiry/general/sender', ScopeInterface::SCOPE_STORE);
            $toEmail = $this->_scopeConfig->
            getValue("trans_email/" . $getSenderEmail . "/email", ScopeInterface::SCOPE_STORE);
            $toName = $this->_scopeConfig->
            getValue("trans_email/" . $getSenderEmail . "/email", ScopeInterface::SCOPE_STORE);
            $emailTemplate = $this->_scopeConfig->
            getValue('product_inquiry/general/email_template', ScopeInterface::SCOPE_STORE);

            $sender = [
                'email' => $this->_escaper->escapeHtml($email),
                'name' => $this->_escaper->escapeHtml($name)
            ];

            if ($emailTemplate && $toEmail && $toName) {
                $transport = $this->_transportBuilder->setTemplateIdentifier($emailTemplate)
                    ->setTemplateOptions(['area' => 'frontend', 'store' => $store])
                    ->setTemplateVars(
                        [
                            'Name' => $name,
                            'Phone' => $telephone,
                            'Email' => $email,
                            'Description' => $message,
                            'Sku' => $sku
                        ]
                    )
                    ->setFrom($sender)
                    ->addTo($toEmail, $toName)
                    ->getTransport();

                $transport->sendMessage();
            }
        } catch (\Exception $e) {
        }
    }
}
