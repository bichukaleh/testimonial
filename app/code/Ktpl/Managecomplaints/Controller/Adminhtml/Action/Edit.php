<?php

namespace Ktpl\Managecomplaints\Controller\Adminhtml\Action;

use Ktpl\Managecomplaints\Model\ManagecomplaintsFactory;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\Auth\Session;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;

class Edit extends \Magento\Backend\App\Action
{
    /**  @var ManagecomplaintsFactory */
    protected $_managecomplaintsFactory;
    /** @var JsonFactory */
    protected $jsonFactory;
    /**
     * @var TimezoneInterface
     */
    protected $_timezoneInterface;

    /**
     * Edit constructor.
     * @param Context $context
     * @param JsonFactory $jsonFactory
     * @param ManagecomplaintsFactory $managecomplaintsFactory
     * @param Session $authSession
     * @param TimezoneInterface $timezone
     */
    public function __construct(Context $context, JsonFactory $jsonFactory, ManagecomplaintsFactory $managecomplaintsFactory, Session $authSession, TimezoneInterface $timezone)
    {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->_managecomplaintsFactory = $managecomplaintsFactory;
        $this->authSession = $authSession;
        $this->_timezoneInterface = $timezone;
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
                $error = true;
            } else {
                foreach (array_keys($postArray) as $modelid) {
                    $managecomplaints = $this->_managecomplaintsFactory->create();
                    $managecomplaints->setId($modelid);

                    try {
                        $existingData = $managecomplaints->getCollection()->addFieldToFilter('managecomplaints_id', ['eq' => $modelid])->getData();

                        $loggednInUserDetails = $this->authSession->getUser()->getData();
                        $username = $loggednInUserDetails['username'];
                        $date = $this->_timezoneInterface->date()->format('M d,Y H:i:s');
                        if (count($postArray[$modelid]) == 1 && key_exists('comment', $postArray[$modelid])) {
                            $commentArray = explode($existingData[0]['comment'], $postArray[$modelid]['comment']);
                            $newComment = '';
                            foreach ($commentArray as $comment) {
                                if ($comment != "") {
                                    $newComment .= trim($comment) . " \n Comment updated on $date By $username. \n\n";
                                    $newComment .= $existingData[0]['comment'];
                                }
                            }
                            $postArray[$modelid]['comment'] = $newComment;
                        } else {
                            $postArray[$modelid]['comment'] = $postArray[$modelid]['comment'] . "\n Commented on $date By $username \n\n";
                            $postArray[$modelid]['comment'] = $postArray[$modelid]['comment'] . $existingData[0]['comment'];
                        }
                        $messages['comment'] = $postArray[$modelid]['comment'];
                        $managecomplaints->setData(array_merge($managecomplaints->getData(), $postArray[$modelid]));
                        $managecomplaints->save();
                    } catch (\Exception $e) {
                        $messages[] = "[Managecomplaints ID: {$modelid}]  {$e->getMessage()}";
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
