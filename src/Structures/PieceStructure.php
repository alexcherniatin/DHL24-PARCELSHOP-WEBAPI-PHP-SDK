<?php

namespace Alexcherniatin\DHLParcelshop\Structures;

use Alexcherniatin\DHLParcelshop\Exceptions\InvalidStructureException;

class PieceStructure
{
    public const TYPE_ENVELOPE = 'ENVELOPE';

    public const TYPE_PACKAGE = 'PACKAGE';

    /**
     * One of the values: "ENVELOPE", "PACKAGE"
     *
     *  required
     *
     * @var string
     */
    private $type = '';

    /**
     * Width in centimeters
     *
     * required when type other than "ENVELOPE"
     *
     * @var int
     */
    private $width = 0;

    /**
     * Height in centimeters
     *
     * required when type other than "ENVELOPE"
     *
     * @var int
     */
    private $height = 0;

    /**
     * Length in centimeters
     *
     * required when type other than "ENVELOPE"
     *
     * @var int
     */
    private $length = 0;

    /**
     * Weight in kilograms
     *
     * required when type other than "ENVELOPE"
     *
     * @var int
     */
    private $weight = 0;

    /**
     * Number of packages
     *
     * required
     *
     * @var int
     */
    private $quantity = 0;

    /**
     * Is the package non-standard
     * (as defined in the price list)
     *
     * @var bool
     */
    private $nonStandard = false;

    /**
     * BLP identifier - for customers printing labels of this type, who keep their own parcel numbering
     *
     * @var string
     */
    private $blpPieceId = '';

    /**
     *
     * @param string $type
     *
     * @return PieceStructure
     */
    public function setType(string $type): PieceStructure
    {
        $this->type = $type;

        return $this;
    }

    /**
     *
     * @param int $width
     *
     * @return PieceStructure
     */
    public function setWidth(int $width): PieceStructure
    {
        $this->width = $width;

        return $this;
    }

    /**
     *
     * @param int $height
     *
     * @return PieceStructure
     */
    public function setHeight(int $height): PieceStructure
    {
        $this->height = $height;

        return $this;
    }

    /**
     *
     * @param int $length
     *
     * @return PieceStructure
     */
    public function setLength(int $length): PieceStructure
    {
        $this->length = $length;

        return $this;
    }

    /**
     *
     * @param int $weight
     *
     * @return PieceStructure
     */
    public function setWeight(int $weight): PieceStructure
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     *
     * @param int $quantity
     *
     * @return PieceStructure
     */
    public function setQuantity(int $quantity): PieceStructure
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     *
     * @param bool $nonStandard
     *
     * @return PieceStructure
     */
    public function setNonStandard(bool $nonStandard): PieceStructure
    {
        $this->nonStandard = $nonStandard;

        return $this;
    }

    /**
     *
     * @param string $blpPieceId
     *
     * @return PieceStructure
     */
    public function setBlpPieceId(string $blpPieceId): PieceStructure
    {
        $this->blpPieceId = $blpPieceId;

        return $this;
    }

    /**
     * The structure describes the physical parameters of the packages.
     *
     * @throws InvalidStructureException
     *
     * @return array
     */
    public function structure(): array
    {
        $structure = [];

        if (\strlen($this->type) === 0) {
            throw new InvalidStructureException('PieceStructure type can not be empty');
        }

        if (!\in_array(
            $this->type,
            [
                self::TYPE_ENVELOPE,
                self::TYPE_PACKAGE,
            ]
        )) {
            throw new InvalidStructureException('PieceStructure type available values is: ENVELOPE, PACKAGE');
        }

        $structure['type'] = $this->type;

        if ($this->type !== self::TYPE_ENVELOPE) {
            if ($this->width === 0) {
                throw new InvalidStructureException('PieceStructure width required when type other than "ENVELOPE"');
            }

            if ($this->height === 0) {
                throw new InvalidStructureException('PieceStructure height required when type other than "ENVELOPE"');
            }

            if ($this->length === 0) {
                throw new InvalidStructureException('PieceStructure length required when type other than "ENVELOPE"');
            }

            if ($this->weight === 0) {
                throw new InvalidStructureException('PieceStructure weight required when type other than "ENVELOPE"');
            }
        }

        if ($this->width !== 0) {
            $structure['width'] = $this->width;
        }

        if ($this->height !== 0) {
            $structure['height'] = $this->height;
        }

        if ($this->length !== 0) {
            $structure['lenght'] = $this->length;
        }

        if ($this->weight !== 0) {
            $structure['weight'] = $this->weight;
        }

        if ($this->quantity !== 0) {
            $structure['quantity'] = $this->quantity;
        } else {
            throw new InvalidStructureException('Piece quantity required');
        }

        $structure['nonStandard'] = $this->nonStandard;

        if (\strlen($this->blpPieceId) > 0) {
            $structure['blpPieceId'] = $this->blpPieceId;
        }

        return $structure;
    }
}
