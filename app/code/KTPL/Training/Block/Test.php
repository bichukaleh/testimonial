<?php

namespace KTPL\Training\Block;

use Magento\Framework\View\Element\Template;
use Magento\Variable\Model\VariableFactory;
use Magento\Framework\View\Element\Template\Context;
class Test extends Template
{
    protected $_varFactory;
    /**
     * Test constructor.
     * @param VariableFactory $varFactory
     * @param Context $context
     */
    public function __construct(VariableFactory $varFactory, Context $context)
    {
        $this->_varFactory = $varFactory;
        parent::__construct($context);
    }

    /**
     * @param $code
     * @return string
     */
    public function getVariableValue($code)
    {
        $var = $this->_varFactory->create();
        $var->loadByCode($code);
        return $var->getValue('plain');
//        return $var->getValue('text');
    }
}