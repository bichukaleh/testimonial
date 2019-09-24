<?php


namespace KTPL\Testimonial\Controller\Adminhtml\Testimonial;

abstract class Testimonial extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'KTPL_Testimonial::top_level';
    protected $_coreRegistry;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function initPage($resultPage)
    {
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE)
            ->addBreadcrumb(__('KTPL'), __('KTPL'))
            ->addBreadcrumb(__('Testimonial'), __('Testimonial'));
        return $resultPage;
    }
}
