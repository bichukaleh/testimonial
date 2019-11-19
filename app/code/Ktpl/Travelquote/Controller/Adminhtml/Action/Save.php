<?php

namespace Ktpl\Travelquote\Controller\Adminhtml\Action;

use Ktpl\Travelquote\Model\TravelquoteFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;

class Save extends Action
{
    /**  @var TravelquoteFactory */
    protected $_travelquoteFactory;

    /**
     * Save constructor.
     * @param Context $context
     * @param TravelquoteFactory $travelquoteFactory
     */
    public function __construct(Context $context, TravelquoteFactory $travelquoteFactory)
    {
        $this->_travelquoteFactory = $travelquoteFactory;
        parent::__construct($context);
    }

    /**
     * save data and redirect to listing page
     * @return ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $postItems = $this->getRequest()->getParams();
        if (!empty($postItems)) {
            $input = $postItems;
            $input['sku'] = 'new_travel_package';
            $travelquote = $this->_travelquoteFactory->create();
            if (count($input)) {
                try {
                    $travelquote->setData($input)->save();
                    $this->messageManager->addSuccessMessage(__('Travel quote added successfully..'));
                } catch (\Exception $exception) {
                    $this->messageManager->addErrorMessage(__($exception->getMessage()));
                }
            }
        }
        return $this->_redirect('ktpl_travelquote/action/index');
    }
}
