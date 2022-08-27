<?php

namespace SSZ\Calculator\models;

use SSZ\Calculator\Str;

/**
 * Class ModelAbstract
 * @package app\components\Model
 */
abstract class ModelAbstract implements \ArrayAccess
{
    /**
     * @param array $attributes
     */
    public function __construct( array $attributes = [] )
    {
        $this->setAttributes( $attributes );
    }

    /**
     * @param array $attributes
     */
    public function setAttributes( array $attributes )
    {
        foreach ( $attributes as $key => $value ) {
            if ( isset( $this->attributes[ $key ] ) ) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function __get( string $name )
    {
        $method = 'get' . Str::studly( $name ) . 'Attribute';

        if ( method_exists( $this, $method ) ) {
            return $this->$method();
        }

        if ( isset( $this->attributes[ $name ] ) ) {
            return $this->attributes[ $name ];
        }

        return null;
    }

    /**
     * @param string $name
     * @param $value
     * @return void
     */
    public function __set( string $name, $value )
    {
        $method = 'set' . Str::studly( $name ) . 'Attribute';

        if ( method_exists( $this, $method ) ) {
            return $this->$method( $value );
        }

        $this->attributes[ $name ] = $value;
    }

    /**
     * @param array $attributes
     * @return static
     */
    public static function initByAttributes( array $attributes = [] )
    {
        return new static( $attributes );
    }

    /**
     * @var array
     */
    public $attributes = [];

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet( $offset, $value )
    {
        if ( is_null( $offset ) ) {
            $this->attributes[] = $value;
        } else {
            $this->attributes[ $offset ] = $value;
        }
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists( $offset )
    {
        return isset( $this->attributes[ $offset ] );
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset( $offset )
    {
        unset( $this->attributes[ $offset ] );
    }

    /**
     * @param mixed $offset
     * @return mixed|null
     */
    public function offsetGet( $offset )
    {
        return $this->attributes[ $offset ] ?? null;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->attributes;
    }
}