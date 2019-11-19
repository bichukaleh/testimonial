<?php

namespace Ktpl\Travelquote\Ui\Component\Listing\Column;

use Ktpl\Travelquote\Model\Travelquote;
use Magento\Framework\Data\OptionSourceInterface;

class NumberOfPersonOptions implements OptionSourceInterface
{

    /**
     * @var Travelquote
     */
    protected $_travelquote;

    /**
     * NumberOfPersonOptions constructor.
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
        $optionData = $this->_travelquote->getNumberOfPersons();
        foreach ($optionData as $label => $value) {
            $options[] = ['label' => "$label", 'value' => $value];
        }
        return $options;
    }
}
