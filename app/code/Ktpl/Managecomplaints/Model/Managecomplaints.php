<?php

namespace Ktpl\Managecomplaints\Model;

use Magento\Framework\Model\AbstractModel;

class Managecomplaints extends AbstractModel
{
    /**
     * Bind Resource model
     */
    protected function _construct()
    {
        $this->_init('Ktpl\Managecomplaints\Model\ResourceModel\Managecomplaints');
    }

    /**
     * get status of solved
     * @return array
     */
    public function getSolvedStatus()
    {
        return [
            'Yes' => 'Yes',
            'No' => 'No',
        ];
    }

    /**
     * get list of solutions
     * @return array
     */
    public function getSolutionsOptions()
    {
        return [
            'Customer Refunded' => 'Customer Refunded',
            'Amount Credited to Account' => 'Amount Credited to Account',
            'Reward Points Given' => 'Reward Points Given',
            'Postpone offer' => 'Postpone offer'
        ];
    }

    /**
     * get list of responsible
     * @return array
     */
    public function getResponsibleOptions()
    {
        return [
            'MD Issue' => 'MD Issue',
            'Merchant Issue' => 'Merchant Issue'
        ];
    }
    /**
     * get list of reasons
     * @return array
     */
    public function getReasons()
    {
        return [
            'Stop sales not applied' => 'Stop sales not applied',
            'Pricing error' => 'Pricing error',
            'Mistakes in offer bought' => 'Mistakes in offer bought',
            'Min. nights requirement not respected' => 'Min. nights requirement not respected',
            'System error – dates not appearing on reservation' => 'System error – dates not appearing on reservation',
            'Allotment did not work/MariDeal oversold' => 'Allotment did not work/MariDeal oversold',
            'Allotment not applied' => 'Allotment not applied',
            'Request: Agent did not revert to client for a request' => 'Request: Agent did not revert to client for a request',
            'Stop sales / payment done and booking not confirmed' => 'Stop sales / payment done and booking not confirmed',
            'Agent did not mention certain offer conditions or provided a wrong info' => 'Agent did not mention certain offer conditions or provided a wrong info',
            'Client did not appreciate conversation with the agent' => 'Client did not appreciate conversation with the agent',
            'Complaints further to issues' => 'Complaints further to issues',
            'Agent did not book as per client’s requirements' => 'Agent did not book as per client’s requirements',
            'Client did not appreciate product/service (after use)' => 'Client did not appreciate product/service (after use)',
            'Stop sales not received' => 'Stop sales not received',
            'Hotel seeking help under overbooking situation or issues with room/property' => 'Hotel seeking help under overbooking situation or issues with room/property',
            'Request sent, but nothing done' => 'Request sent, but nothing done',
            'Issues arising at check-in because of confusion or mal-organization with booking confirmations' => 'Issues arising at check-in because of confusion or mal-organization with booking confirmations',
            'Deal conditions not respected' => 'Deal conditions not respected',
            'Client not happy with the product/service advertised specially upon arrival' => 'Client not happy with the product/service advertised specially upon arrival',
            'Others' => 'Others'
        ];
    }
}
