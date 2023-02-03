<?php

namespace Petite\Container;

use Psr\Container\ContainerInterface;
use ReflectionClass;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionUnionType;

class Container implements ContainerInterface
{
    private array $entries = [];

    public function get(string $id)
    {
        if($this->has($id)) {
            $entry = $this->entries[$id];
            return $entry($this);
        }
        return $this->resolve($id);
    }

    public function resolve(string $id)
    {
        $reflectionClass = new ReflectionClass($id);

        if(!$reflectionClass->isInstantiable()) {
            throw new ContainerException('Class ' . $id . 'is not instantiable');
        }

        $constructor = $reflectionClass->getConstructor();

        if(!$constructor) {
            return new $id;
        }

        $parameters = $constructor->getParameters();

        if(!$parameters) {
            return new $id;
        }

        $dependencies = array_map(function(ReflectionParameter $param) {
            $name = $param->getName();
            $type = $param->getType();

            if(!$type) {
                throw new ContainerException($param . ' is not type hinted');
            }

            if($type instanceof ReflectionUnionType) {
                throw new ContainerException($param . ' is not named typed');
            }

            if ($type instanceof ReflectionNamedType && ! $type->isBuiltin()) {
                return $this->get($type->getName());
            }
            throw new ContainerException($param . ' is not a valid parameter');
        }, $parameters);

        return $reflectionClass->newInstanceArgs($dependencies);
    }
    
    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }

    public function set(string $id, callable $concrete): void
    {
        $this->entries[$id] = $concrete;
    }
}