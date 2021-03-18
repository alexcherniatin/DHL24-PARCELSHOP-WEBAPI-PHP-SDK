<?php

require_once '../vendor/autoload.php';

require_once 'ExamplesConfig.php';

use Alexcherniatin\DHLParcelshop\DHL24Parcelshop;

$dhl = new DHL24Parcelshop(
    ExamplesConfig::LOGIN,
    ExamplesConfig::PASSWORD,
    ExamplesConfig::ACCOUNT_NUMBER,
    ExamplesConfig::SANDBOX
);

echo '<pre>';

try {

    $points = $dhl->getNearestServicepoints('01771', 'Warszawa', 3);

    $pointsCOD = $dhl->getNearestServicepointsCOD('01771', 'Warszawa', 3);

    print_r($points);

    print_r($pointsCOD);

} catch (\Throwable $th) {
    echo $th->getMessage();
}
