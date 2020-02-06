<?php
namespace Ivatsko\RequestPrice\Model\RequestPrice\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{
    protected $requestPrice;

    public function __construct(\Ivatsko\RequestPrice\Model\RequestPrice $requestPriceConstruct)
    {
        $this->requestPrice = $requestPriceConstruct;
    }

    public function toOptionArray()
    {
        $availableOptions = $this->requestPrice->getAvailableStatuses();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
?>
