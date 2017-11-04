<?php
declare(strict_types=1);

namespace AppBundle\Helper;

/**
 * Class StringTools
 * @package AppBundle\Helper
 */
class StringTools
{

    /**
     * @param $word
     * @return array
     */
    public static function mbCountChars($word): array
    {
        return array_count_values(preg_split('//u', $word, 0, PREG_SPLIT_NO_EMPTY));
    }

    /**
     * @param $word
     * @return array
     */
    public static function mbReturnChars($word): array
    {
        return preg_split('//u', $word, 0, PREG_SPLIT_NO_EMPTY);
    }

    /**
     * @param $word
     * @return string
     */
    public static function sortChars($word): string
    {
        $array = StringTools::mbReturnChars($word);
        asort($array);
        return implode($array);
    }
}
