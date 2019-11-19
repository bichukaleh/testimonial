<?php

namespace Ktpl\Travelquote\Ui\Component\Listing\Column;

use Ktpl\Travelquote\Model\Travelquote;
use Magento\Framework\Data\OptionSourceInterface;

class AdultOptions implements OptionSourceInterface
{

    /**
     * @var Travelquote
     */
    protected $_travelquote;

    /**
     * AdultOptions constructor.
     * @param Travelquote $travelquote
     */
    public function __construct(Travelquote $travelquote)
    {
        $this->_travelquote = $travelquote;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $optionData = $this->_travelquote->getNumberOfAdults();
        foreach ($optionData as $label => $value) {
            $options[] = ['label' => "$label", 'value' => $value];
        }
        return $options;
    }
}
