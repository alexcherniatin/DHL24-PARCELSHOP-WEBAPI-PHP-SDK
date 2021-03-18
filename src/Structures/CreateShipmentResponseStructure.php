<?php

namespace Alexcherniatin\DHLParcelshop\Structures;

use Alexcherniatin\DHLParcelshop\Exceptions\InvalidStructureException;

class CreateShipmentResponseStructure
{
    /**
     * Shipment waybill number
     *
     * @var string
     */
    private $shipmentNumber = '';

    /**
     * Structure containing the label to be printed
     *
     * @var array
     */
    private $label = [];

    /**
     *
     * @param string $shipmentNumber
     *
     * @return CreateShipmentResponseStructure
     */
    public function setShipmentNumber(string $shipmentNumber): CreateShipmentResponseStructure
    {
        $this->shipmentNumber = $shipmentNumber;

        return $this;
    }

    /**
     *
     * @param array $label
     *
     * @return CreateShipmentResponseStructure
     */
    public function setLabel(array $label): CreateShipmentResponseStructure
    {
        $this->label = $label;

        return $this;
    }

    /**
     * The described structure is an object returned by the createShipment method
     *
     * @throws InvalidStructureException
     *
     * @return array
     */
    public function structure(): array
    {
        if (\strlen($this->shipmentNumber) === 0) {
            throw new InvalidStructureException("CreateShipmentResponseStructure shipmentNumber required");
        }

        if (\count($this->label) === 0) {
            throw new InvalidStructureException("CreateShipmentResponseStructure label required");
        }

        return [
            'shipmentNumber' => $this->shipmentNumber,
            'label' => $this->label,
        ];
    }

    /**
     * Build structure from response
     *
     * @param object $response
     * 
     * @throws InvalidStructureException
     * 
     * @return array
     */
    public function fromResponse(object $response): array
    {
        $this->shipmentNumber = $response->shipmentNumber ?? '';

        $this->label = (new LabelStructure())
            ->setLabelType($response->label->labelType ?? '')
            ->setLabelFormat($response->label->labelFormat ?? '')
            ->setLabelContent($response->label->labelContent ?? '')
            ->setLabelName($response->label->labelName ?? '')
            ->structure();

        return $this->structure();
    }
}
