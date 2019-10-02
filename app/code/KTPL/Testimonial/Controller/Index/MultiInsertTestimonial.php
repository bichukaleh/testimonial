<?php

namespace KTPL\Testimonial\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;

class MultiInsertTestimonial extends Action
{
    protected $_resource;
    protected $_timezoneInterface;
    protected $_connection;

    /**
     * MultiInsertTestimonial constructor.
     * @param Context $context
     * @param ResourceConnection $resourceConnection
     * @param TimezoneInterface $timezone
     */
    public function __construct(
        Context $context,
        ResourceConnection $resourceConnection,
        TimezoneInterface $timezone
    ) {
        $this->_timezoneInterface = $timezone;
        $this->_resource = $resourceConnection;
        $this->_connection = $resourceConnection->getConnection();
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|string
     */
    public function execute()
    {
        for ($cnt = 1; $cnt < 4; $cnt++) {
            $input[] = [
                'name' => 'multiInsert' . $cnt,
                'email' => "multiInsert$cnt@gamil.com",
                'is_approved' => 0,
                'updated_at' => $this->_timezoneInterface->date()->format('m/d/y H:i:s'),
                'created_at' => $this->_timezoneInterface->date()->format('m/d/y H:i:s'),
                'sort_order' => 11,
                'ratings'=>4,
                'message'=>'multi insert demo',
                'image'=>'DjZEo.jpg'
            ];
        }

        /** @var \Exception $exception */
        try {
            $table = $this->_resource->getTableName('ktpl_testimonial');
//            $this->_connection->insertMultiple($table, $input);
            $this->messageManager->addSuccessMessage(__('Multiple Testimonials added successfully..'));
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
        }
        return $this->_redirect('testimonial/index/newtestimonial');
    }
}
