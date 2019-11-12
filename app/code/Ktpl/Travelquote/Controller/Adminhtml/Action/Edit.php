<?php

namespace Ktpl\Travelquote\Controller\Adminhtml\Action;

use Ktpl\Travelquote\Model\TravelquoteFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Backend\App\Action;

class Edit extends Action
{
    /**  @var TravelquoteFactory */
    protected $_travelquoteFactory;
    /** @var JsonFactory */
    protected $jsonFactory;

    /**
     * Edit constructor.
     * @param Context $context
     * @param JsonFactory $jsonFactory
     * @param TravelquoteFactory $travelquoteFactory
     */
    public function __construct(Context $context, JsonFactory $jsonFactory, TravelquoteFactory $travelquoteFactory)
    {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->_travelquoteFactory = $travelquoteFactory;
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
            $postItems = $this->getRequest()->getParams();

            $postArray[$postItems['id']] = $postItems;
            unset($postArray[$postItems['id']]['isAjax']);
            unset($postArray[$postItems['id']]['id']);
            unset($postArray[$postItems['id']]['form_key']);
            if (!count($postArray)) {
                $messages[] = __('Please correct the data sent.');
            } else {
                foreach (array_keys($postArray) as $modelid) {
                    $travelquote = $this->_travelquoteFactory->create();
                    $travelquote->setId($modelid);
                    try {
                        $travelquote->setData(array_merge($travelquote->getData(), $postArray[$modelid]));
                        $travelquote->save();
                    } catch (\Exception $e) {
                        $messages[] = "[Travelquote ID: {$modelid}]  {$e->getMessage()}";
                        $error = true;
                        return $resultJson->setData([
                            'messages' => $messages,
                            'error' => $error
                        ]);
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'responseText' => 1
        ]);
    }
}
