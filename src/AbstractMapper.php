<?php

namespace DerTechie\DataMapping;

use DerTechie\DataMapping\Exceptions\NoMappingFoundException;

abstract class AbstractMapper implements MapperInterface
{
    public function map($from): object
    {
        $type = is_array($from) ? 'array' : get_class($from);

        foreach ($this->getMappings() as $mapping)
        {
            if($mapping->getType() === $type)
            {
                return $mapping->getMethod()($from);
            }
        }

        throw new NoMappingFoundException($type, static::getType());
    }
}