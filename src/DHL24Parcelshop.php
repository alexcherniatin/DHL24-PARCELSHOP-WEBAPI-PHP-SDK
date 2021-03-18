<?php

namespace Alexcherniatin\DHLParcelshop;

use Alexcherniatin\DHLParcelshop\Client;
use Alexcherniatin\DHLParcelshop\Exceptions\DHL24Exception;
use Alexcherniatin\DHLParcelshop\Exceptions\SoapException;
use Alexcherniatin\DHLParcelshop\Structures\AuthData;
use Alexcherniatin\DHLParcelshop\Structures\CreateShipmentResponseStructure;
use Alexcherniatin\DHLParcelshop\Structures\LabelStructure;
use Alexcherniatin\DHLParcelshop\Utils;

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

        if (!$this->client) {
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
    public function createShipment(array $shipmentData): array
    {
        $params = [
            'shipment' => [
                'authData' => $this->authData,
                'shipmentData' => $shipmentData,
            ],
        ];

        $result = $this->client->createShipment($params);

        if (!isset($result->createShipmentResult)) {
            throw new SoapException('Invalid response structure');
        }

        return (new CreateShipmentResponseStructure())->fromResponse($result->createShipmentResult);
    }

    /**
     * Get label
     *
     * @param string $shipmentId
     * @param string $type BLP or ZBLP
     *
     * @throws SoapException
     * @throws SoapFault
     * @throws InvalidStructureException
     * @throws DHL24Exception
     *
     * @return array
     */
    public function getLabel(string $shipmentId, string $type = 'BLP'): array
    {
        $params = [
            'structure' => [
                'authData' => $this->authData,
                'shipment' => $shipmentId,
                'type' => $type,
            ],
        ];

        $result = $this->client->getLabel($params);

        if (!isset($result->getLabelResult)) {
            throw new SoapException('Invalid response structure');
        }

        return (new LabelStructure())
            ->setLabelType($result->getLabelResult->labelType)
            ->setLabelFormat($result->getLabelResult->labelFormat)
            ->setLabelContent($result->getLabelResult->labelContent)
            ->setLabelName($result->getLabelResult->labelName)
            ->structure();
    }

    /**
     * Get PNP
     *
     * @param string $shipmentDate Date for which the PNP report is to be generated (YYYY-MM-DD)
     *
     * @throws SoapException
     * @throws SoapFault
     * @throws InvalidStructureException
     * @throws DHL24Exception
     *
     * @return array
     */
    public function getPnp(string $shipmentDate): array
    {
        $params = [
            'structure' => [
                'authData' => $this->authData,
                'shipmentDate' => $shipmentDate,
            ],
        ];

        $result = $this->client->getPnp($params);

        if (!isset($result->getPnpResult)) {
            throw new SoapException('Invalid response structure');
        }

        return (new LabelStructure())
            ->setLabelType($result->getPnpResult->labelType)
            ->setLabelFormat($result->getPnpResult->labelFormat)
            ->setLabelContent($result->getPnpResult->labelContent)
            ->setLabelName($result->getPnpResult->labelName)
            ->structure();
    }

    /**
     * Using this method, it is possible to find the nearest service points
     *
     * @param string $postcode
     * @param string $city
     * @param int $radius
     *
     * @throws SoapException
     * @throws SoapFault
     *
     * @return object
     */
    public function getNearestServicepoints(string $postcode, string $city, int $radius): object
    {
        $params = [
            'structure' => [
                'authData' => $this->authData,
                'postcode' => Utils::onlyNumbers($postcode),
                'city' => $city,
                'radius' => $radius,
            ],
        ];

        $result = $this->client->getNearestServicepoints($params);

        if (!isset($result->getNearestServicepointsResult)) {
            throw new SoapException('Invalid response structure');
        }

        return $result->getNearestServicepointsResult->points;
    }

    /**
     * Using this method, it is possible to find the nearest service points with COD
     *
     * @param string $postcode
     * @param string $city
     * @param int $radius
     *
     * @throws SoapException
     * @throws SoapFault
     *
     * @return object
     */
    public function getNearestServicepointsCOD(string $postcode, string $city, int $radius): object
    {
        $params = [
            'structure' => [
                'authData' => $this->authData,
                'postcode' => Utils::onlyNumbers($postcode),
                'city' => $city,
                'radius' => $radius,
            ],
        ];

        $result = $this->client->getNearestServicepointsCOD($params);

        if (!isset($result->getNearestServicepointsCODResult)) {
            throw new SoapException('Invalid response structure');
        }

        return $result->getNearestServicepointsCODResult->points;

    }
}
