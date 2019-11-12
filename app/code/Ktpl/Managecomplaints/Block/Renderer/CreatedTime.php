<?php

namespace Ktpl\Managecomplaints\Block\Renderer;

use Magento\Backend\Block\Context;
use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\DataObject;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;

class CreatedTime extends AbstractRenderer
{
    /**
     * @var TimezoneInterface
     */
    protected $_timezoneInterface;

    /**
     * CreatedTime constructor.
     * @param Context $context
     * @param TimezoneInterface $timezone
     * @param array $data
     */
    public function __construct(Context $context, TimezoneInterface $timezone, array $data = [])
    {
        $this->_timezoneInterface = $timezone;
        parent::__construct($context, $data);
    }

    /**
     * Render date in given format
     * @param DataObject $row
     * @return string
     */
    public function render(DataObject $row)
    {
        $html = $this->_timezoneInterface->date($row['created_time'])->format('M d,Y H:i:s A');
        return $html;
    }
}
