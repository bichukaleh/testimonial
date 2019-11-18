<?php

namespace Ktpl\Travelquote\Block\Renderer;

use Magento\Backend\Block\Context;
use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\DataObject;

class AgentComment extends AbstractRenderer
{
    /**
     * AgentComment constructor.
     * @param Context $context
     * @param array $data
     */
    public function __construct(Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    /**
     * Render agent comment textarea
     * @param DataObject $row
     * @return string
     */
    public function render(DataObject $row)
    {
        $id = 'agent_comment' . $row['id'];
        $html = "<textarea name='agent_comment' id='$id' rows='8' cols='25' style='resize: none'>" . $row['agent_comment'] . "</textarea>";
        return $html;
    }
}
