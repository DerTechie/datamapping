# About Der Techie - DataMapping
In modern PHP Applications there is often a need for coping with data mappings. Many applications use class
methods like `fromArray` or `fromXXX` on their Models / Entities. This might work for built-in types like array
or objects in the same context. But as soon as someone tries to map from an object out of context, things get messy.

This library provides a clean and decoupled way to cope with Data Mappings.

# Installation
The preferred method of installation is via Composer. The following command will add the appropriate requirement to
your composer.json:

`composer require dertechie/datamapping`

# Using the Library
Let's assume we have a simple Object that we want to map:

```php
<?php

namespace DerTechie\Entities;

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
```

To enable mapping for this object we simply need to add the MappableTrait to the class. This will add the `from` method
to the object.

In order to map the object, we need a Mapper class that handles all of our mappings.

```php
<?php

namespace DerTechie\Mappers;

use DerTechie\DataMapping\AbstractMapper;
use DerTechie\Entities\MyObject;

class MyObjectMapper extends AbstractMapper
{
    public static function getType(): string
    {
        return MyObject::class;
    }

    public function fromArray(array $source): MyObject
    {
        $obj = new MyObject();

        $obj->setId($source['id']);
        $obj->setName($source['name']);

        return $obj;
    }

    public function fromCreateMyObjectRequest(CreateMyObjectRequest $request): MyObject
    {
        $obj = new MyObject();
        
        $obj->setId($request->input('id'));
        $obj->setName($request->input('name'));
  
        return $obj;
    }

    public function getMappings(): array
    {
        return [
            new Mapping('array', [$this, 'fromArray']),
            new Mapping(CreateMyObjectRequest::class, [$this, 'fromCreateMyObjectRequest'])
        ];
    }
}
```

The key parts here are the class method `getType()` and the method `getMappings()`. `getType()` defines the type this
Mapper is responsible for mapping to. The `getMappings()` method expects to return an array of available Mappings. The
first parameters defines the type this mapping maps to, and the second parameter defines the callback that is used for
the mapping.

To use the mapper, it needs to be registered. To do so simply call:

`MapperRegistry::register(MyObjectMapper::class)`

Now you can use the convenient `from` method on your object to map it: `MyObject::from(['id' => '1', 'name' => 'Foo']);`