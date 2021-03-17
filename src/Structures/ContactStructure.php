<?php

namespace Alexcherniatin\DHLParcelshop\Structures;

use Alexcherniatin\DHLParcelshop\Exceptions\InvalidStructureException;
use Alexcherniatin\DHLParcelshop\Utils;

class ContactStructure
{
    /**
     * Company name or first and last name
     *
     * (50)
     *
     * required
     *
     * @var string
     */
    private $personName = '';

    /**
     * Phone number
     *
     * (9)
     *
     * required
     *
     * @var string
     */
    private $phoneNumber = '';

    /**
     * Email address in the form of name@domain.com
     *
     * (100)
     *
     * required
     *
     * @var string
     */
    private $emailAddress = '';

    /**
     *
     * @param string $personName
     *
     * @return ContactStructure
     */
    public function setPersonName(string $personName): ContactStructure
    {
        $this->personName = $personName;

        return $this;
    }

    /**
     *
     * @param string $phoneNumber
     *
     * @return ContactStructure
     */
    public function setPhoneNumber(string $phoneNumber): ContactStructure
    {
        $this->phoneNumber = Utils::onlyNumbers($phoneNumber);

        return $this;
    }

    /**
     *
     * @param string $emailAddress
     *
     * @return ContactStructure
     */
    public function setEmailAddress(string $emailAddress): ContactStructure
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    /**
     * The described structure is an object used to transfer contact data.
     *
     * @throws InvalidStructureException
     *
     * @return array
     */
    public function structure(): array
    {
        if (\strlen($this->personName) === 0) {
            throw new InvalidStructureException("ContactStructure personName required");
        }

        if (\strlen($this->phoneNumber) === 0) {
            throw new InvalidStructureException("ContactStructure phoneNumber required");
        }

        if (\strlen($this->emailAddress) === 0) {
            throw new InvalidStructureException("ContactStructure emailAddress required");
        }

        $structure = [];

        $structure['personName'] = $this->personName;

        $structure['phoneNumber'] = $this->phoneNumber;

        $structure['emailAddress'] = $this->emailAddress;

        return $structure;
    }
}
