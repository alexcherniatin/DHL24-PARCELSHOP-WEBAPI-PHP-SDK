<?php

namespace Alexcherniatin\DHLParcelshop;

class Client extends \SoapClient
{
    const WSDL_LIVE = "https://dhl24.com.pl/servicepoint";

    const WSDL_SANDBOX = "https://sandbox.dhl24.com.pl/servicepoint";

    public function __construct(bool $sanbox = false)
    {
        $wsdl = ($sanbox) ? self::WSDL_SANDBOX : self::WSDL_LIVE;

        parent::__construct($wsdl);
    }

}
