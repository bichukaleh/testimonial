<?php

namespace KTPL\Customization\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

class Data extends AbstractHelper
{
    /**
     * Data constructor.
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    /**
     * get list of status
     * @return array
     */
    public function getStatus()
    {
        return [
            '0' => 'Pending',
            '1' => 'Approved',
            '2' => 'Disapproved',
        ];
    }
}
