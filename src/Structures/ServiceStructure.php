<?php

namespace Alexcherniatin\DHLParcelshop\Structures;

use Alexcherniatin\DHLParcelshop\Exceptions\InvalidStructureException;

class ServiceStructure
{
    public const SERVICE_TYPE_COD = 'COD';

    public const SERVICE_TYPE_INSURANCE = 'UBEZP';

    public const COD_FORM = 'BANK_TRANSFER';

    /**
     * Type of additional service: UBEZP - COD shipment insurance - COD return
     *
     * required
     *
     * @var string
     */
    private $serviceType = '';

    /**
     * Declared value (for UBEZP or COD)
     *
     * @var int
     */
    private $serviceValue = 0;

    /**
     * Additional text (32)
     *
     * @var string
     */
    private $textInstruction = '';

    /**
     * The method of returning - only BANK_TRANSFER
     *
     * (13)
     *
     * @var string
     */
    private $collectOnDeliveryForm = '';

    /**
     *
     * @param string $serviceType
     *
     * @return ServiceStructure
     */
    public function setServiceType(string $serviceType): ServiceStructure
    {
        $this->serviceType = $serviceType;

        return $this;
    }

    /**
     *
     * @param int $serviceValue
     *
     * @return ServiceStructure
     */
    public function setServiceValue(int $serviceValue): ServiceStructure
    {
        $this->serviceValue = $serviceValue;

        return $this;
    }

    /**
     *
     * @param string $textInstruction
     *
     * @return ServiceStructure
     */
    public function setTextInstruction(string $textInstruction): ServiceStructure
    {
        $this->textInstruction = $textInstruction;

        return $this;
    }

    /**
     *
     * @param string $collectOnDeliveryForm
     *
     * @return ServiceStructure
     */
    public function setCollectOnDeliveryForm(string $collectOnDeliveryForm): ServiceStructure
    {
        $this->collectOnDeliveryForm = $collectOnDeliveryForm;

        return $this;
    }

    /**
     * The structure described is an object that describes additional shipping services.
     *
     * @throws InvalidStructureException
     *
     * @return array
     */
    public function structure(): array
    {

        if (!\in_array(
            $this->serviceType,
            [
                self::SERVICE_TYPE_COD,
                self::SERVICE_TYPE_INSURANCE,
            ]
        )) {
            throw new InvalidStructureException('ServiceStructure serviceType available values is: COD, UBEZP');
        }

        $structure = [];

        $structure['serviceType'] = $this->serviceType;

        $structure['serviceValue'] = $this->serviceValue;

        if (\strlen($this->textInstruction) > 0) {
            $structure['textInstruction'] = $this->textInstruction;
        }

        if (\strlen($this->collectOnDeliveryForm) > 0) {
            $structure['collectOnDeliveryForm'] = $this->collectOnDeliveryForm;
        }

        return $structure;
    }
}
