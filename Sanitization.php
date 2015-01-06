<?php

class Sanitization extends CFormModel {

    const ALPHA_LOWER = 'abcdefghijklmnñopqrstuvwxyz';
    const ALPHA_UPPER = 'ABCDEFGHIJKLMNÑOPQRSTUVWXYZ';
    const NUM = '0123456789';
    const ALPHA_SPACE = ' ';
    const ALPHA_PUNCTUATION = '-_.,!?:;';
    const HEX = '0123456789abcdefABCDEF';
    const HEX_UPPER = '0123456789ABCDEF';
    const HEX_LOWER = '0123456789abcdef';
    const OCTAL = '0124567';
    const INTEGER = '0123456789-';
    const FLOAT = '0123456789.e-';

    /*
     * Section INT
     */

    public static function IntOnly($value = NULL, $returncero = FALSE) {

        //$value = trim($value);
        $value = filter_var($value, FILTER_VALIDATE_INT);
        if ($returncero) {
            $value = intval($value);
        }
        return $value;
    }

    public static function IntOnlyRange($value = NULL, $min = 0, $max = 0, $returncero = FALSE) {

        //$value = trim($value);
        $value = filter_var($value, FILTER_VALIDATE_INT, array("options" => array("min_range" => intval($min), "max_range" => intval($max))));
        if ($returncero) {
            $value = intval($value);
        }
        return $value;
    }

    public static function IntClean($value = NULL, $returncero = FALSE) {

        //$value = trim(@$value);
        $value = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
        if ($returncero) {
            $value = intval($value);
        }
        return $value;
    }

    public static function IntArray($value = array()) {

        //$value = trim(@$value);
        $value = filter_var_array($value, FILTER_VALIDATE_INT);

        return $value;
    }

    public static function IntPositive($value = NULL, $returncero = FALSE) {

        //$value = trim($value);
        $value = filter_var($value, FILTER_VALIDATE_INT, array("options" => array("min_range" => 0)));
        if ($returncero) {
            $value = intval($value);
        }
        return $value;
    }

    public static function IntNegative($value = NULL, $returncero = FALSE) {

        //$value = trim($value);
        $value = filter_var($value, FILTER_VALIDATE_INT, array("options" => array("max_range" => 0)));
        if ($returncero) {
            $value = intval($value);
        }
        return $value;
    }

    /*
     * Section String 
     */

    public static function StringAZ($value = NULL, $spaces = TRUE) {

        $value = filter_var($value, FILTER_SANITIZE_STRING);

        $allowable = self::ALPHA_LOWER . self::ALPHA_UPPER;

        if ($spaces == TRUE) {
            $allowable .= self::ALPHA_SPACE;
        }

        $value = Sanitization::SanitizacionString($value, $allowable);

        return $value;
    }

    public static function StringAZCharacters($value = NULL, $characters = NULL, $spaces = TRUE) {

        $value = filter_var($value, FILTER_SANITIZE_STRING);

        $allowable = self::ALPHA_LOWER . self::ALPHA_UPPER . $characters;

        if ($spaces == TRUE) {
            $allowable .= self::ALPHA_SPACE;
        }

        $value = Sanitization::SanitizacionString($value, $allowable);

        return $value;
    }

    public static function StringAZ09($value = NULL, $spaces = TRUE) {
        $value = filter_var($value, FILTER_SANITIZE_STRING);

        $allowable = self::ALPHA_LOWER . self::ALPHA_UPPER . self::NUM;

        if ($spaces == TRUE) {
            $allowable .= self::ALPHA_SPACE;
        }

        $value = Sanitization::SanitizacionString($value, $allowable);

        return $value;
    }

    public static function StringAZ09Characters($value = NULL, $characters = NULL, $spaces = TRUE) {
        $value = filter_var($value, FILTER_SANITIZE_STRING);

        $allowable = self::ALPHA_LOWER . self::ALPHA_UPPER . self::NUM . $characters;

        if ($spaces == TRUE) {
            $allowable .= self::ALPHA_SPACE;
        }

        $value = Sanitization::SanitizacionString($value, $allowable);

        return $value;
    }

    public static function StringAZ09Puntuation($value = NULL, $characters = NULL, $spaces = TRUE) {
        $value = filter_var($value, FILTER_SANITIZE_STRING);

        $allowable = self::ALPHA_LOWER . self::ALPHA_UPPER . self::NUM . self::ALPHA_PUNCTUATION . $characters;

        if ($spaces == TRUE) {
            $allowable .= self::ALPHA_SPACE;
        }

        $value = Sanitization::SanitizacionString($value, $allowable);

        return $value;
    }

    public static function Float($value = NULL, $separator = '.') {
        
    }

    /*
     * Funciones generales de uso en la Clase para reutilizar Codigo
     */

    public static function SanitizacionString($value = NULL, $whitelist = NULL) {


        $allowed_chars = str_split($whitelist);
        $size = strlen($value);
        $output = '';

        // Walk through the input
        for ($i = 0; $i < $size; $i++) {
            $char = $value[$i];
            // Check to see if the current char is allowed...
            if (in_array($char, $allowed_chars)) {
                // if allowed... add to the output string.
                $output .= $char;
            } else {
                
            }
        }
        return $output;
    }

}
