<?php

namespace DerTechie\DataMapping\Exceptions;

use Exception;
use Throwable;

class TypeAlreadyRegisteredException extends Exception
{
    public function __construct(string $type)
    {
        parent::__construct("Type '{$type}' has allready been registered within the MapperRegistry.");
    }
}