<?php

namespace Alexcherniatin\DHLParcelshop;

use Alexcherniatin\DHLParcelshop\Client;
use Alexcherniatin\DHLParcelshop\Exceptions\DHL24Exception;
use Alexcherniatin\DHLParcelshop\Exceptions\SoapException;
use Alexcherniatin\DHLParcelshop\Structures\AuthData;

class DHL24Parcelshop
{
    /**
     * Soap client
     *
     * @var Client
     */
    private $client = null;

    /**
     * Auth data structure
     *
     * @var array
     */
    private $authData = [];

    /**
     * DHL account number
     *
     * @var string
     */
    private $accountNumber = '';

    public function __construct(string $login, string $password, string $accountNumber, bool $sandbox = false)
    {
        $this->client = new Client($sandbox);

        if(!$this->client){
            throw new SoapException("Connection error");
        }

        $this->authData = (new AuthData($login, $password))->structure();

        $this->accountNumber = $accountNumber;
    }


    /**
     * Create shipment
     *
     * @param array $shipment
     *
     * @throws SoapException
     * @throws SoapFault
     * @throws InvalidStructureException
     *
     * @return array
     */
    public function createShipment(array $shipment): array
    {}

    /**
     * Get label
     *
     * @param array $itemsToPrint Array of ItemToPrint structures, 3 items max
     *
     * @throws SoapException
     * @throws SoapFault
     * @throws InvalidStructureException
     * @throws DHL24Exception
     *
     * @return array
     */
    public function getLabel(array $itemsToPrint): array
    {}
}
