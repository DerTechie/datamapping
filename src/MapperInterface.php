<?php

namespace DerTechie\DataMapping;

interface MapperInterface
{
    /**
     * @return string
     */
    public static function getType(): string;

    /**
     * @return Mapping[]
     */
    public function getMappings(): array;

    /**
     * @param $from
     * @return object
     */
    public function map($from): object;
}