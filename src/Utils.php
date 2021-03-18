<?php

namespace Alexcherniatin\DHLParcelshop;

use Alexcherniatin\DHLParcelshop\Exceptions\DHL24Exception;

class Utils
{
    /**
     * Save label to folder
     *
     * @param array $labels ItemToPrintResponse
     * @param string $labelsFolder Server folder path
     *
     * @throws DHL24Exception
     *
     * @return array Saved files name
     */
    public static function saveLabel(array $label, string $labelsFolder): string
    {
        if (\file_exists($labelsFolder) === false) {
            throw new DHL24Exception('Folder does not exist');
        }

        $fileName = $label['labelType'] . $label['labelName'];

        if (self::saveFile($labelsFolder . $fileName, $label['labelContent']) === false) {
            throw new DHL24Exception('Saving label error');
        }

        return $fileName;
    }

    /**
     * Save file to folder
     *
     * @param string $name
     * @param string $data
     *
     * @return bool
     */
    public static function saveFile(string $name, string $data): bool
    {
        return \file_put_contents($name, \base64_decode($data));
    }

    /**
     * Remove all symbols except numbers from string
     *
     * @param string $text
     *
     * @return string
     */
    public static function onlyNumbers(string $text): string
    {
        return \trim(\preg_replace('/[^0-9]/', '', $text));
    }
}
