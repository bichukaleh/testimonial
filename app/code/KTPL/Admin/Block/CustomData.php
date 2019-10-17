<?php


namespace KTPL\Admin\Block;


class CustomData extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        array $data = []
    )
    {
        $this->_coreRegistry = $context->getRegistry();
        parent::__construct($context, $data);
    }

    /**
     * Retrieve current product object
     *
     * @return \Magento\Catalog\Model\Product
     */
    public function getProduct()
    {
        if (!$this->hasData('product')) {
            $this->setData('product', $this->_coreRegistry->registry('product'));
        }
        return $this->getData('product');
    }

    /**
     * @return string
     */
    public function getTabsContent()
    {
        $data = [
            'title' => $this->getProduct()->getCustomTitle(),
            'comment' => $this->getProduct()->getCustomComment()
        ];
        return $data;
    }

    /**
     * @return return HTML
     */
    protected function _toHtml()
    {
        if (!empty($this->getTabsContent())) {
            return parent::_toHtml();
        }

        return false;
    }
}