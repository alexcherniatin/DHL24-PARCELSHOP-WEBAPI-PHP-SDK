<?php

namespace Alexcherniatin\DHLParcelshop\Structures;

use Alexcherniatin\DHLParcelshop\Exceptions\InvalidStructureException;

class FullAddressDataStructure
{
    /**
     * Address data
     *
     * required
     *
     * @var array
     */
    private $address = [];

    /**
     * Contact data
     *
     * required
     *
     * @var array
     */
    private $contact = [];

    /**
     * Data to be used in pre-announcement
     *
     * required
     *
     * @var array
     */
    private $preaviso = [];

    /**
     *
     * @param array $address
     *
     * @return FullAddressDataStructure
     */
    public function setAddress(array $address): FullAddressDataStructure
    {
        $this->address = $address;

        return $this;
    }

    /**
     *
     * @param array $contact
     *
     * @return FullAddressDataStructure
     */
    public function setContact(array $contact): FullAddressDataStructure
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     *
     * @param array $preaviso
     *
     * @return FullAddressDataStructure
     */
    public function setPreaviso(array $preaviso): FullAddressDataStructure
    {
        $this->preaviso = $preaviso;

        return $this;
    }

    /**
     * The described structure is an object used for storing contact data.
     *
     * @throws InvalidStructureException
     *
     * @return array
     */
    public function structure(): array
    {
        if (\count($this->address) === 0) {
            throw new InvalidStructureException("FullAddressDataStructure address required");
        }

        if (\count($this->contact) === 0) {
            throw new InvalidStructureException("FullAddressDataStructure contact required");
        }

        if (\count($this->preaviso) === 0) {
            throw new InvalidStructureException("FullAddressDataStructure preaviso required");
        }

        $structure = [];

        $structure['address'] = $this->address;

        $structure['contact'] = $this->contact;

        $structure['preaviso'] = $this->preaviso;

        return $structure;
    }
}
