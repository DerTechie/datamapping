<?php

namespace DerTechie\DataMapping;

class Mapping
{
    protected string $type;

    protected $method;

    /**
     * Mapping constructor.
     * @param string $type
     * @param callable $method
     */
    public function __construct(string $type, callable $method)
    {
        $this->type = $type;
        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return callable
     */
    public function getMethod(): callable
    {
        return $this->method;
    }
}