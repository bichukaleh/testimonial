<?php

namespace Ktpl\Travelquote\Ui\Component\Listing\Column;

use Magento\Framework\Data\OptionSourceInterface;

class FelxibleDateOptions implements OptionSourceInterface
{

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            ['label' => "My travel dates are not flexible", 'value' => 0],
            ['label' => "My travel dates are flexible", 'value' => 1]
        ];
        return $options;
    }
}
