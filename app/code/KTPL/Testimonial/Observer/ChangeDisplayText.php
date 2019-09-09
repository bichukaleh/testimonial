<?php
/**
 * Created by PhpStorm.
 * User: heena
 * Date: 18/9/19
 * Time: 5:31 PM
 */
namespace KTPL\Testimonial\Observer;

class ChangeDisplayText implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $displayText = $observer->getData('mp_text');
        echo $displayText->getText() . " - Event </br>";
        $displayText->setText('Execute event successfully.');

        return $this;
    }
}
