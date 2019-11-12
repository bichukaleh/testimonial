<?php

namespace Ktpl\Managecomplaints\Block\Renderer;

use Magento\Backend\Block\Context;
use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\DataObject;

class CommentBox extends AbstractRenderer
{
    /**
     * CommentBox constructor.
     * @param Context $context
     * @param array $data
     */
    public function __construct(Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    /**
     * Render comment with textarea
     * @param DataObject $row
     * @return string
     */
    public function render(DataObject $row)
    {
        $id='comment' . $row['managecomplaints_id'];
        $html = "<textarea name='comment' id='$id' rows='8' cols='25' style='resize: none' >" . $row['comment'] . "</textarea>";
        return $html;
    }
}
