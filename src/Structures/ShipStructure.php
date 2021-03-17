<?php

namespace Alexcherniatin\DHLParcelshop\Structures;

use Alexcherniatin\DHLParcelshop\Exceptions\InvalidStructureException;

class ShipStructure
{
    /**
     * Sender's address structure
     * 
     * required
     *
     * @var array 
    */
    private $shipper = [];

    /**
     * Receiver's address structure
     * 
     * required
     *
     * @var array 
    */
    private $receiver = [];

    /**
     * SAP service point number required to get the address
     * 
     * required
     *
     * @var string 
    */
    private $servicePointAccountNumber = '';

    /**
     *
     * @param array $shipper
     *
     * @return ShipStructure 
    */
    public function setShipper(array $shipper): ShipStructure
    {
        $this->shipper = $shipper;

        return $this;
    }

    /**
     *
     * @param array $receiver
     *
     * @return ShipStructure 
    */
    public function setReceiver(array $receiver): ShipStructure
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     *
     * @param string $servicePointAccountNumber
     *
     * @return ShipStructure 
    */
    public function setServicePointAccountNumber(string $servicePointAccountNumber): ShipStructure
    {
        $this->servicePointAccountNumber = $servicePointAccountNumber;

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
        if(\count($this->shipper) === 0){
            throw new InvalidStructureException("ShipStructure shipper required");
        }

        if(\count($this->receiver) === 0){
            throw new InvalidStructureException("ShipStructure receiver required");
        }

        if(\strlen($this->servicePointAccountNumber) === 0){
            throw new InvalidStructureException("ShipStructure servicePointAccountNumber required");
        }

        $structure = [];

        $structure['shipper'] = $this->shipper;

        $structure['receiver'] = $this->receiver;

        $structure['servicePointAccountNumber'] = $this->servicePointAccountNumber;

        return $structure;
    }
}