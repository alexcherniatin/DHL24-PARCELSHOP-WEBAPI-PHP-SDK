<?php

require_once '../vendor/autoload.php';

require_once 'ExamplesConfig.php';

use Alexcherniatin\DHLParcelshop\DHL24Parcelshop;
use Alexcherniatin\DHLParcelshop\Utils;

$dhl = new DHL24Parcelshop(
    ExamplesConfig::LOGIN,
    ExamplesConfig::PASSWORD,
    ExamplesConfig::ACCOUNT_NUMBER,
    ExamplesConfig::SANDBOX
);

echo '<pre>';

try {

    $label = $dhl->getLabel('90012331470', 'BLP');

    $savedLabelFileName = Utils::saveLabel($label, 'labels/');

    print_r($label);

    print_r($savedLabelFileName);

} catch (\Throwable $th) {
    echo $th->getMessage();
}
