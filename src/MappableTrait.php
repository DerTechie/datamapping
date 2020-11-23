<?php

namespace DerTechie\DataMapping;

trait MappableTrait
{
    /**
     * @param $source
     * @return object
     */
    public static function from($source): object
    {
        $mapper = MapperRegistry::get(static::class);

        return $mapper->map($source);
    }
}