<?php

namespace Alexcherniatin\DHLParcelshop\Structures;

use Alexcherniatin\DHLParcelshop\Exceptions\InvalidStructureException;
use Alexcherniatin\DHLParcelshop\Utils;

class AddressStructure
{
    public const ADDRESS_TYPE_B = 'B';

    public const ADDRESS_TYPE_C = 'C';

    /**
     * Address type (B/C)
     * (1)
     *
     * @var string
     */
    private $addressType = '';

    /**
     * Company name or first and last name
     * (60) required
     *
     * @var string
     */
    private $name = '';

    /**
     * Zip code, no hyphen
     * (10) required
     *
     * @var string
     */
    private $postalCode = '';

    /**
     * City name
     * (17) required
     *
     * @var string
     */
    private $city = '';

    /**
     * Street
     * (35) requred
     *
     * @var string
     */
    private $street = '';

    /**
     * House number
     * The sum of characters in fields "apartmentNumber" and "houseNumber" cannot exceed 15 characters
     * (10) required
     *
     * @var string
     */
    private $houseNumber = '';

    /**
     * Apartment number The sum of characters in "apartmentNumber" and "houseNumber" fields cannot exceed 15 characters (10)
     *
     * @var string
     */
    private $apartmentNumber = '';

    public function setName(string $name): AddressStructure
    {
        $this->name = $name;

        return $this;
    }

    public function setPostalCode(string $postalCode): AddressStructure
    {
        $this->postalCode = Utils::onlyNumbers($postalCode);

        return $this;
    }

    public function setCity(string $city): AddressStructure
    {
        $this->city = $city;

        return $this;

    }

    public function setStreet(string $street): AddressStructure
    {
        $this->street = $street;

        return $this;
    }

    public function setHouseNumber(string $houseNumber): AddressStructure
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }

    public function setApartmentNumber(string $apartmentNumber): AddressStructure
    {
        $this->apartmentNumber = $apartmentNumber;

        return $this;
    }

    public function setAddressType(string $addressType): AddressStructure
    {
        $this->addressType = $addressType;

        return $this;
    }

    /**
     * The described structure is an object used to transfer address data.
     *
     * @throws InvalidStructureException
     *
     * @return array
     */
    public function structure(): array
    {
        $structure = [];

        if (\strlen($this->name) === 0) {
            throw new InvalidStructureException('AddressStructure name required');
        }

        $structure['name'] = $this->name;

        if (\strlen($this->postalCode) === 0) {
            throw new InvalidStructureException('AddressStructure postal code required');
        }

        $structure['postcode'] = $this->postalCode;

        if (\strlen($this->city) === 0) {
            throw new InvalidStructureException('AddressStructure city required');
        }

        $structure['city'] = $this->city;

        if (\strlen($this->street) === 0) {
            throw new InvalidStructureException('AddressStructure street required');
        }

        $structure['street'] = $this->street;

        if (\strlen($this->houseNumber) === 0) {
            throw new InvalidStructureException('AddressStructure house number required');
        }

        $structure['houseNumber'] = $this->houseNumber;

        if (\strlen($this->apartmentNumber) > 0) {
            $structure['apartmentNumber'] = $this->apartmentNumber;
        }

        if (\strlen($this->addressType) > 0) {
            if (!\in_array(
                $this->addressType,
                [
                    self::ADDRESS_TYPE_B,
                    self::ADDRESS_TYPE_C,
                ]
            )) {
                throw new InvalidStructureException('AddressStructure address type available values is: B, C');
            }

            $structure['addressType'] = $this->addressType;
        }

        return $structure;
    }

}
