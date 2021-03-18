<?php

namespace Alexcherniatin\DHLParcelshop\Structures;

use Alexcherniatin\DHLParcelshop\Exceptions\InvalidStructureException;

class ShipmentStructure
{
    /**
     * Address and contact details
     *
     * required
     *
     * @var array
     */
    private $ship = [];

    /**
     * Shipment details
     *
     * required
     *
     * @var array
     */
    private $shipmentInfo = [];

    /**
     * Data on transported goods
     *
     * required
     *
     * @var array
     */
    private $pieceList = [];

    /**
     * Identification of the content (30)
     *
     * required
     *
     * @var string
     */
    private $content = '';

    /**
     * Comment (100)
     *
     * @var string
     */
    private $comment = '';

    /**
     * Additional text field (200)
     *
     * @var string
     */
    private $reference = '';

    /**
     *
     * @param array $ship
     *
     * @return ShipmentStructure
     */
    public function setShip(array $ship): ShipmentStructure
    {
        $this->ship = $ship;

        return $this;
    }

    /**
     *
     * @param array $shipmentInfo
     *
     * @return ShipmentStructure
     */
    public function setShipmentInfo(array $shipmentInfo): ShipmentStructure
    {
        $this->shipmentInfo = $shipmentInfo;

        return $this;
    }

    /**
     *
     * @param array $pieceList
     *
     * @return ShipmentStructure
     */
    public function setPieceList(array $pieceList): ShipmentStructure
    {
        $this->pieceList = $pieceList;

        return $this;
    }

    /**
     *
     * @param string $content
     *
     * @return ShipmentStructure
     */
    public function setContent(string $content): ShipmentStructure
    {
        $this->content = $content;

        return $this;
    }

    /**
     *
     * @param string $comment
     *
     * @return ShipmentStructure
     */
    public function setComment(string $comment): ShipmentStructure
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     *
     * @param string $reference
     *
     * @return ShipmentStructure
     */
    public function setReference(string $reference): ShipmentStructure
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * The described structure is an object used to describe shipments in the system.
     *
     * @throws InvalidStructureException
     *
     * @return array
     */
    public function structure(): array
    {

        if (\count($this->ship) === 0) {
            throw new InvalidStructureException('ShipmentStructure ship required');
        }

        if (\count($this->shipmentInfo) === 0) {
            throw new InvalidStructureException('ShipmentStructure shipmentInfo required');
        }

        if (\count($this->pieceList) === 0) {
            throw new InvalidStructureException('ShipmentStructure pieceList required');
        }

        if (\strlen($this->content) === 0) {
            throw new InvalidStructureException('ShipmentStructure content required');
        }

        $structure = [];

        $structure['ship'] = $this->ship;

        $structure['shipmentInfo'] = $this->shipmentInfo;

        $structure['pieceList'] = $this->pieceList;

        $structure['content'] = $this->content;

        if (\strlen($this->comment) > 0) {
            $structure['comment'] = $this->comment;
        }

        if (\strlen($this->reference) > 0) {
            $structure['reference'] = $this->reference;
        }

        return $structure;
    }
}
