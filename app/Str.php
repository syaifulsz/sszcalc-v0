<?php

namespace SSZ\Calculator;

/**
 * Class Str
 * @package SSZ\Calculator
 */
class Str
{
    /**
     * @param $value
     * @return string
     */
    public static function studly( $value ): string
    {
        $words = explode(' ', str_replace( ['-', '_'], ' ', $value ) );
        $studlyWords = array_map( function ( $word ) {
            return ucfirst( $word );
        }, $words );
        return implode( $studlyWords );
    }
}