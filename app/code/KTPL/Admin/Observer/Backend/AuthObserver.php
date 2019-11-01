<?php

namespace KTPL\Admin\Observer\Backend;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;
use Magento\User\Model\User;
use KTPL\Admin\Model\AdminLogFactory;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
class AuthObserver implements ObserverInterface
{
    /** @var AdminLogFactory */
    protected $adminLogFactory;
    /** @var TimezoneInterface */
    protected $timezone;

    /**
     * AuthObserver constructor.
     * @param AdminLogFactory $adminLogFactory
     * @param TimezoneInterface $timezone
     */
    public function __construct(AdminLogFactory $adminLogFactory, TimezoneInterface $timezone)
    {
        $this->adminLogFactory = $adminLogFactory;
        $this->timezone = $timezone;
    }

    /**
     * @param EventObserver $observer
     * @throws \Exception
     */
    public function execute(EventObserver $observer)
    {
        $user = $observer->getEvent()->getUser();
        $authResult = $observer->getEvent()->getResult();
        $data = [
            'username' => $user->getUserName(),
            'ip-address' => $_SERVER['REMOTE_ADDR'],
            'status' => $authResult,
            'created_at' => $this->timezone->date()->format('Y-m-d H:i:s')
        ];
        try {
            $adminLog = $this->adminLogFactory->create();
//            $adminLog->setData($data)->save();
        } catch (Exception $exception) {
            $this->messageManager->addErrorMessage(__("Failed to save Admin login log!"));
        }
    }

}