<?php
/**
 * Created by PhpStorm.
 * User: heena
 * Date: 19/9/19
 * Time: 11:28 AM
 */
namespace KTPL\Testimonial\Plugin;

use KTPL\Testimonial\Controller\Index\Test;
class TestPlugin{

    public function beforeSetTitle(Test $subject, $title)
    {
        $title = $title . " to ";
        echo __METHOD__ . "</br>";

        return [$title];
    }

    public function afterGetTitle(Test $subject, $result)
    {

        echo __METHOD__ . "</br>";

        return '<h1>'. $result . 'Testimonials' .'</h1>';

    }

    public function aroundGetTitle(Test $subject, callable $proceed)
    {

        echo __METHOD__ . " - Before proceed() </br>";
        $result = $proceed();
        echo __METHOD__ . " - After proceed() </br>";


        return $result;
    }
}

