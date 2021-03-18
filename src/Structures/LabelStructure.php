<?php

namespace Alexcherniatin\DHLParcelshop\Structures;

use Alexcherniatin\DHLParcelshop\Exceptions\InvalidStructureException;

class LabelStructure
{
    /**
     * Label type - BLP, ZBLP or PNP
     *
     * @var string
     */
    private $labelType = '';

    /**
     * MIME format of the label file being sent
     *
     * @var string
     */
    private $labelFormat = '';

    /**
     * Base64 encoded label file content
     *
     * @var string
     */
    private $labelContent = '';

    /**
     * The name of the label file
     *
     * @var string
     */
    private $labelName = '';

    /**
     *
     * @param string $labelType
     *
     * @return LabelStructure
     */
    public function setLabelType(string $labelType): LabelStructure
    {
        $this->labelType = $labelType;

        return $this;
    }

    /**
     *
     * @param string $labelFormat
     *
     * @return LabelStructure
     */
    public function setLabelFormat(string $labelFormat): LabelStructure
    {
        $this->labelFormat = $labelFormat;

        return $this;
    }

    /**
     *
     * @param string $labelContent
     *
     * @return LabelStructure
     */
    public function setLabelContent(string $labelContent): LabelStructure
    {
        $this->labelContent = $labelContent;

        return $this;
    }

    /**
     *
     * @param string $labelName
     *
     * @return LabelStructure
     */
    public function setLabelName(string $labelName): LabelStructure
    {
        $this->labelName = $labelName;

        return $this;
    }

    /**
     * This structure is returned by the getLabel, createShipment, and getPnp methods
     *
     * @throws InvalidStructureException
     *
     * @return array
     */
    public function structure(): array
    {
        if (\strlen($this->labelType) === 0) {
            throw new InvalidStructureException('InvalidStructureException labelType required');
        }
        
        if (\strlen($this->labelFormat) === 0) {
            throw new InvalidStructureException('InvalidStructureException labelFormat required');
        }

        if (\strlen($this->labelContent) === 0) {
            throw new InvalidStructureException('InvalidStructureException labelContent required');
        }

        if (\strlen($this->labelName) === 0) {
            throw new InvalidStructureException('InvalidStructureException labelName required');
        }

        $structure = [];

        $structure['labelType'] = $this->labelType;

        $structure['labelFormat'] = $this->labelFormat;

        $structure['labelContent'] = $this->labelContent;

        $structure['labelName'] = $this->labelName;

        return $structure;
    }
}
