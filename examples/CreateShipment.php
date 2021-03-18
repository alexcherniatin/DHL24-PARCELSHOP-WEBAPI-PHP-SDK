<?php

require_once '../vendor/autoload.php';

require_once 'ExamplesConfig.php';

use Alexcherniatin\DHLParcelshop\DHL24Parcelshop;
use Alexcherniatin\DHLParcelshop\Structures\AddressStructure;
use Alexcherniatin\DHLParcelshop\Structures\BillingStructure;
use Alexcherniatin\DHLParcelshop\Structures\ContactStructure;
use Alexcherniatin\DHLParcelshop\Structures\FullAddressDataStructure;
use Alexcherniatin\DHLParcelshop\Structures\PieceStructure;
use Alexcherniatin\DHLParcelshop\Structures\ServiceStructure;
use Alexcherniatin\DHLParcelshop\Structures\ShipmentInfoStructure;
use Alexcherniatin\DHLParcelshop\Structures\ShipmentStructure;
use Alexcherniatin\DHLParcelshop\Structures\ShipStructure;
use Alexcherniatin\DHLParcelshop\Utils;

$dhl = new DHL24Parcelshop(
    ExamplesConfig::LOGIN,
    ExamplesConfig::PASSWORD,
    ExamplesConfig::ACCOUNT_NUMBER,
    ExamplesConfig::SANDBOX
);

$shipperAddress = (new AddressStructure())
    ->setName('Tester Test')
    ->setPostalCode('01-771')
    ->setCity('Warszawa')
    ->setStreet('Braci Załuskich')
    ->setHouseNumber('3a')
    ->setApartmentNumber('100')
    ->structure();

$shipperContact = (new ContactStructure())
    ->setPersonName('Tester Shipper')
    ->setPhoneNumber('893-848-484')
    ->setEmailAddress('shipper@test.com')
    ->structure();

$shipperPreaviso = (new ContactStructure())
    ->setPersonName('Tester Shipper')
    ->setPhoneNumber('893-848-484')
    ->setEmailAddress('shipper@test.com')
    ->structure();

$shipper = (new FullAddressDataStructure())
    ->setAddress($shipperAddress)
    ->setContact($shipperContact)
    ->setPreaviso($shipperPreaviso)
    ->structure();

$receiverAddress = (new AddressStructure())
    ->setName('Tester Test')
    ->setPostalCode('01-771')
    ->setCity('Warszawa')
    ->setStreet('Braci Załuskich')
    ->setHouseNumber('3a')
    ->setApartmentNumber('100')
    ->setAddressType(AddressStructure::ADDRESS_TYPE_C)
    ->structure();

$receiverContact = (new ContactStructure())
    ->setPersonName('Tester Receiver')
    ->setPhoneNumber('111-333-444')
    ->setEmailAddress('receiver@test.com')
    ->structure();

$receiverPreaviso = (new ContactStructure())
    ->setPersonName('Tester Receiver')
    ->setPhoneNumber('111-333-444')
    ->setEmailAddress('receiver@test.com')
    ->structure();

$receiver = (new FullAddressDataStructure())
    ->setAddress($receiverAddress)
    ->setContact($receiverContact)
    ->setPreaviso($receiverPreaviso)
    ->structure();

$ship = (new ShipStructure())
    ->setShipper($shipper)
    ->setReceiver($receiver)
    ->setServicePointAccountNumber('4500016')
    ->structure();

$billing = (new BillingStructure())
    ->setShippingPaymentType(BillingStructure::PAYER_SHIPPER)
    ->setBillingAccountNumber(ExamplesConfig::ACCOUNT_NUMBER)
    ->setPaymentType(BillingStructure::PAYMENT_TYPE_BANK_TRANSFER)
    ->structure();

$specialServices = [];

//COD
/*
$specialServices[] = (new ServiceStructure())
->setServiceType(ServiceStructure::SERVICE_TYPE_COD)
->setServiceValue(150)
->setCollectOnDeliveryForm(ServiceStructure::COD_FORM)
->structure();
 */

//Insurance
$specialServices[] = (new ServiceStructure())
    ->setServiceType(ServiceStructure::SERVICE_TYPE_INSURANCE)
    ->setServiceValue(150)
    ->structure();

$shipmentInfo = (new ShipmentInfoStructure())
    ->setDropOffType(ShipmentInfoStructure::DROP_OFF_REQUEST_COURIER)
    ->setServiceType(ShipmentInfoStructure::SERVICE_TYPE_LM)
    ->setBilling($billing)
    ->setSpecialServices($specialServices)
    ->setShipmentDate('2021-03-19')
    ->setShipmentStartHour('12:00')
    ->setShipmentEndHour('17:00')
    ->setLabelType(ShipmentInfoStructure::LABEL_TYPE_BLP)
    ->structure();

$pieceList = [];

$pieceList[] = (new PieceStructure)
    ->setType(PieceStructure::TYPE_PACKAGE)
    ->setWidth(50)
    ->setHeight(25)
    ->setLength(25)
    ->setWeight(3)
    ->setQuantity(1)
    ->structure();

$shipmentData = (new ShipmentStructure())
    ->setShip($ship)
    ->setShipmentInfo($shipmentInfo)
    ->setPieceList($pieceList)
    ->setContent('Some content')
    ->structure();

echo '<pre>';

try {

    $result = $dhl->createShipment($shipmentData);

    $savedLabelFileName = Utils::saveLabel($result['label'], 'labels/');

    print_r($result);

    print_r($savedLabelFileName);

} catch (\Throwable $th) {
    echo $th->getMessage();
}
