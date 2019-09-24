<?php


namespace KTPL\Testimonial\Controller\Index;

use Magento\Framework\App\Router\NoRouteHandlerInterface;
use Magento\Framework\App\RequestInterface;

class NoRouteHandler implements NoRouteHandlerInterface
{
    /**
     * @param RequestInterface $request
     * @return bool
     */

    public function process(RequestInterface $request)
    {
        $moduleName = 'testimonial';
        $controllerName = 'index';
        $actionName = 'CustomNoRoute';

        $request
            ->setRouteName($moduleName)
            ->setControllerName($controllerName)
            ->setActionName($actionName);
        return true;
    }
}