<?php

namespace DerTechie\DataMapping\Exceptions;

use Exception;
use Throwable;

class NoMappingFoundException extends Exception
{
    public function __construct(string $fromType, string $toType)
    {
        parent::__construct("No Mapping [{$fromType}] -> [{$toType}] found.");
    }

}