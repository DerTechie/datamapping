<?php

namespace DerTechie\DataMapping;

use DerTechie\DataMapping\Exceptions\TypeAlreadyRegisteredException;

class MapperRegistry implements MapperRegistryInterface
{
    protected static array $mappers = [];

    /**
     * @param MapperInterface $mapper
     * @throws TypeAlreadyRegisteredException
     */
    public static function register(MapperInterface $mapper): void
    {
        if(array_key_exists($mapper->getType(), static::$mappers))
        {
            throw new TypeAlreadyRegisteredException($mapper->getType());
        }

        static::$mappers[$mapper->getType()] = $mapper;
    }

    /**
     * @param string $type
     * @return MapperInterface
     */
    public static function get(string $type): MapperInterface
    {
        return static::$mappers[$type];
    }
}
