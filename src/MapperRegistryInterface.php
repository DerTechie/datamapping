<?php

namespace DerTechie\DataMapping;

interface MapperRegistryInterface
{
    public static function register(MapperInterface $mapper): void;

    public static function get(string $type): MapperInterface;
}