<?php

namespace Alexcherniatin\DHLParcelshop\Structures;

use Alexcherniatin\DHLParcelshop\Exceptions\InvalidStructureException;

class ShipmentInfoStructure
{
    public const DROP_OFF_REGULAR_PICKUP = 'REGULAR_PICKUP';

    public const DROP_OFF_REQUEST_COURIER = 'REQUEST_COURIER';

    public const SERVICE_TYPE_LM = 'LM';

    public const LABEL_TYPE_BLP = 'BLP';

    public const LABEL_TYPE_ZBLP = 'ZBLP';

    /**
     * Service type - available only: REGULAR_PICKUP and REQUEST_COURIER
     *
     * required
     *
     * @var string
     */
    private $dropOffType = '';

    /**
     * Shipping Service - Available only: LM
     * 
     * required
     *
     * @var string
     */
    private $serviceType = '';

    /**
     * Payment data
     * 
     * required
     *
     * @var array
     */
    private $billing = [];

    /**
     * Additional services
     *
     * @var array
     */
    private $specialServices = [];

    /**
     * Date of posting (YYYY-MM-DD)
     * 
     * required
     *
     * @var string
     */
    private $shipmentDate = '';

    /**
     * The beginning of the hourly range in which the courier is to pick up the parcel; in HH: MM format
     * 
     * required
     *
     * @var string
     */
    private $shipmentStartHour = '';

    /**
     * End of hour range in which the courier is to pick up the parcel in HH: MM format
     * 
     * required
     *
     * @var string
     */
    private $shipmentEndHour = '';

    /**
     * Return label type - available: BLP or ZBLP
     * 
     * required
     *
     * @var string
     */
    private $labelType = '';

    /**
     *
     * @param string $dropOffType
     *
     * @return ShipmentInfoStructure
     */
    public function setDropOffType(string $dropOffType): ShipmentInfoStructure
    {
        $this->dropOffType = $dropOffType;

        return $this;
    }

    /**
     *
     * @param string $serviceType
     *
     * @return ShipmentInfoStructure
     */
    public function setServiceType(string $serviceType): ShipmentInfoStructure
    {
        $this->serviceType = $serviceType;

        return $this;
    }

    /**
     *
     * @param array $billing
     *
     * @return ShipmentInfoStructure
     */
    public function setBilling(array $billing): ShipmentInfoStructure
    {
        $this->billing = $billing;

        return $this;
    }

    /**
     *
     * @param array $specialServices
     *
     * @return ShipmentInfoStructure
     */
    public function setSpecialServices(array $specialServices): ShipmentInfoStructure
    {
        $this->specialServices = $specialServices;

        return $this;
    }

    /**
     *
     * @param string $shipmentDate
     *
     * @return ShipmentInfoStructure
     */
    public function setShipmentDate(string $shipmentDate): ShipmentInfoStructure
    {
        $this->shipmentDate = $shipmentDate;

        return $this;
    }

    /**
     *
     * @param string $shipmentStartHour
     *
     * @return ShipmentInfoStructure
     */
    public function setShipmentStartHour(string $shipmentStartHour): ShipmentInfoStructure
    {
        $this->shipmentStartHour = $shipmentStartHour;

        return $this;
    }

    /**
     *
     * @param string $shipmentEndHour
     *
     * @return ShipmentInfoStructure
     */
    public function setShipmentEndHour(string $shipmentEndHour): ShipmentInfoStructure
    {
        $this->shipmentEndHour = $shipmentEndHour;

        return $this;
    }

    /**
     *
     * @param string $labelType
     *
     * @return ShipmentInfoStructure
     */
    public function setLabelType(string $labelType): ShipmentInfoStructure
    {
        $this->labelType = $labelType;

        return $this;
    }

    /**
     * The described structure is an object that provides information about the shipment.
     *
     * @throws InvalidStructureException
     *
     * @return array
     */
    public function structure(): array
    {
        if (\strlen($this->dropOffType) === 0) {
            throw new InvalidStructureException("ShipmentInfoStructure dropOffType required");
        }

        if (!\in_array(
            $this->dropOffType,
            [
                self::DROP_OFF_REGULAR_PICKUP,
                self::DROP_OFF_REQUEST_COURIER,
            ]
        )) {
            throw new InvalidStructureException('ShipmentInfoStructure dropOffType available values is: REGULAR_PICKUP, REQUEST_COURIER');
        }

        if (\strlen($this->serviceType) === 0) {
            throw new InvalidStructureException("ShipmentInfoStructure serviceType required");
        }

        if (!\in_array(
            $this->serviceType,
            [
                self::SERVICE_TYPE_LM,
            ]
        )) {
            throw new InvalidStructureException('ShipmentInfoStructure serviceType available values is: LM');
        }

        if (\count($this->billing) === 0) {
            throw new InvalidStructureException("ShipmentInfoStructure billing required");
        }

        if (\strlen($this->shipmentDate) === 0) {
            throw new InvalidStructureException("ShipmentInfoStructure shipmentDate required");
        }

        if (\strlen($this->shipmentStartHour) === 0) {
            throw new InvalidStructureException("ShipmentInfoStructure shipmentStartHour required");
        }

        if (\strlen($this->shipmentEndHour) === 0) {
            throw new InvalidStructureException("ShipmentInfoStructure shipmentEndHour required");
        }

        if (\strlen($this->labelType) === 0) {
            throw new InvalidStructureException("ShipmentInfoStructure labelType required");
        }

        if (!\in_array(
            $this->labelType,
            [
                self::LABEL_TYPE_BLP,
                self::LABEL_TYPE_ZBLP,
            ]
        )) {
            throw new InvalidStructureException('ShipmentInfoStructure labelType available values is: BLP, ZBLP');
        }

        $structure = [];

        $structure['dropOffType'] = $this->dropOffType;

        $structure['serviceType'] = $this->serviceType;

        $structure['billing'] = $this->billing;

        $structure['shipmentDate'] = $this->shipmentDate;

        $structure['shipmentStartHour'] = $this->shipmentStartHour;

        $structure['shipmentEndHour'] = $this->shipmentEndHour;

        $structure['labelType'] = $this->labelType;

        if (\count($this->specialServices) > 0) {
            $structure['specialServices'] = $this->specialServices;
        }

        return $structure;
    }
}
