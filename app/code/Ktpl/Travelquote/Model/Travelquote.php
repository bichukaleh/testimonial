<?php

namespace Ktpl\Travelquote\Model;

use Magento\Framework\Model\AbstractModel;

class Travelquote extends AbstractModel
{
    /**
     * Bind Resource model
     */
    protected function _construct()
    {
        $this->_init('Ktpl\Travelquote\Model\ResourceModel\Travelquote');
    }

    /**
     * get list of agents
     * @return array
     */
    public function getAgentList()
    {
        return [
            '66' => 'Sweva', '74' => 'Celia', '76' => 'Yovan', '85' => 'Poomaley', '87' => 'Kambika', '90' => 'Anabelle', '67' => 'Florinda', '71' => 'Wendy', '68' => 'Natacha', '45' => 'Dessen', '62' => 'Agnes', '89' => 'Sophie', '64' => 'Dinesh', '88' => 'Rachna', '119' => 'Pooja', '117' => 'Kingsley', '116' => 'Anousha', '133' => 'Kirtee'
        ];
    }

    /**
     * get list of quote status
     * @return array
     */
    public function getStatus()
    {
        return [
            '1' => 'Pending', '2' => 'Cancel', '3' => 'Complete', '4' => 'New', '5' => 'Quote Sent', '6' => 'Part-Payment'
        ];
    }

    /**
     * get status list of flexible date
     * @return array
     */
    public function getStatusOfFlexibleDate()
    {
        return [
            '0' => 'No', '1' => 'Yes'
        ];
    }

    /**
     * get allowed number of adults
     * @return array
     */
    public function getNumberOfAdults()
    {
        return [
            '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10'
        ];
    }
    /**
     * get allowed number of persons
     * @return array
     */
    public function getNumberOfPersons()
    {
        return [
            '0' => '0','1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10'
        ];
    }

    /**
     * get types of payment
     * @return array
     */
    public function getPaymentTypeList(){
        return[
          '1'=>'Trianon','2'=>'Grand Baie','3'=>'Caudan','4'=>'Flacq','5'=>'Rose belle','6'=>'IB'
        ];
    }
}
