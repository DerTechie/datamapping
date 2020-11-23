<?php

use DerTechie\DataMapping\AbstractMapper;
use DerTechie\DataMapping\MappableTrait;
use DerTechie\DataMapping\MapperRegistry;
use DerTechie\DataMapping\Mapping;

require_once '../vendor/autoload.php';

class MyObject
{
    use MappableTrait;

    private string $id;

    private string $name;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}

class MyObjectMapper extends AbstractMapper
{
    public static function getType(): string
    {
        return MyObject::class;
    }

    public function fromArray(array $source): MyObject
    {
        $obj = new MyObject();

        $obj->setName($source['var1']);

        return $obj;
    }

    public function getMappings(): array
    {
        return [
            new Mapping('array', [$this, 'fromArray'])
        ];
    }
}

MapperRegistry::register(new MyObjectMapper());

$source = [
    'var1' => 'Test'
];

$obj = MyObject::from($source);

echo $obj->getName();