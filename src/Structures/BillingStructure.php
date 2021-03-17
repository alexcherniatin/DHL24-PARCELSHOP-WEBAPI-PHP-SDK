<?php

namespace Alexcherniatin\DHLParcelshop\Structures;

use Alexcherniatin\DHLParcelshop\Exceptions\InvalidStructureException;

class BillingStructure
{
    public const PAYER_SHIPPER = 'SHIPPER';

    public const PAYER_USER = 'USER';

    public const PAYMENT_TYPE_BANK_TRANSFER = 'BANK_TRANSFER';

    /**
     * Payer indication - only SHIPPER or USER
     *
     * required
     *
     * @var string
     */
    private $shippingPaymentType = '';

    /**
     * Shipper's SAP number if the payer SHIPPER
     *
     * @var string
     */
    private $billingAccountNumber = '';

    /**
     * Payment method - only BANK_TRANSFER available
     *
     * required
     *
     * @var string
     */
    private $paymentType = '';

    /**
     * Cost Center (MPK)
     *
     * @var string
     */
    private $costsCenter = '';

    /**
     *
     * @param string $shippingPaymentType
     *
     * @return BillingStructure
     */
    public function setShippingPaymentType(string $shippingPaymentType): BillingStructure
    {
        $this->shippingPaymentType = $shippingPaymentType;

        return $this;
    }

    /**
     *
     * @param string $billingAccountNumber
     *
     * @return BillingStructure
     */
    public function setBillingAccountNumber(string $billingAccountNumber): BillingStructure
    {
        $this->billingAccountNumber = $billingAccountNumber;

        return $this;
    }

    /**
     *
     * @param string $paymentType
     *
     * @return BillingStructure
     */
    public function setPaymentType(string $paymentType): BillingStructure
    {
        $this->paymentType = $paymentType;

        return $this;
    }

    /**
     *
     * @param string $costsCenter
     *
     * @return BillingStructure
     */
    public function setCostsCenter(string $costsCenter): BillingStructure
    {
        $this->costsCenter = $costsCenter;

        return $this;
    }

    /**
     * The described structure is an object that describes the method of payment.
     *
     * @throws InvalidStructureException
     *
     * @return array
     */
    public function structure(): array
    {
        $structure = [];

        if (\strlen($this->shippingPaymentType) === 0) {
            throw new InvalidStructureException("BillingStructure shippingPaymentType required");
        }

        if (\strlen($this->paymentType) === 0) {
            throw new InvalidStructureException("BillingStructure paymentType required");
        }

        if (\strlen($this->billingAccountNumber) === 0 && $this->shippingPaymentType == self::PAYER_SHIPPER) {
            throw new InvalidStructureException("BillingStructure billingAccountNumber required");
        }

        if (!\in_array(
            $this->shippingPaymentType,
            [
                self::PAYER_SHIPPER,
                self::PAYER_USER,
            ]
        )) {
            throw new InvalidStructureException('BillingStructure shippingPaymentType available values is: SHIPPER, USER');
        }

        if (!\in_array(
            $this->paymentType,
            [
                self::PAYMENT_TYPE_BANK_TRANSFER,
            ]
        )) {
            throw new InvalidStructureException('BillingStructure paymentType available values is: BANK_TRANSFER');
        }

        $structure['shippingPaymentType'] = $this->shippingPaymentType;

        if (\strlen($this->billingAccountNumber) > 0) {
            $structure['billingAccountNumber'] = $this->billingAccountNumber;
        }

        $structure['paymentType'] = $this->paymentType;

        if (\strlen($this->costsCenter) > 0) {
            $structure['costsCenter'] = $this->costsCenter;
        }

        return $structure;
    }
}
