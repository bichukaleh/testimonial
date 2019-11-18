<?php
namespace KTPL\Customization\Controller\Adminhtml\Custom;

use KTPL\Testimonial\Model\TestimonialFactory;
class InlineEdit extends \Magento\Backend\App\Action
{
    /**  @var TestimonialFactory */
    protected $_testimonialFactory;
    /** @var \Magento\Framework\Controller\Result\JsonFactory */
    protected $jsonFactory;

    /**
     * InlineEdit constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     * @param TestimonialFactory $testimonialFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory, TestimonialFactory $testimonialFactory
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->_testimonialFactory = $testimonialFactory;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Json|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $modelid) {
                    $testimonial = $this->_testimonialFactory->create();
                    $testimonial->setId($modelid);
                    try {
                        $testimonial->setData(array_merge($testimonial->getData(), $postItems[$modelid]));
                        $testimonial->save();
                    } catch (\Exception $e) {
                        $messages[] = "[Testimonial ID: {$modelid}]  {$e->getMessage()}";
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}