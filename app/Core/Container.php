<?php
namespace App\Core;

use ReflectionClass;
use ReflectionParameter;
use Closure;

/**
 * Simple Dependency Injection Container for TradeSmart.
 * Supports bindings, singletons, and automatic autowiring.
 */
class Container
{
    /** @var array<string, array{resolver:mixed,singleton:bool}> */
    protected array $bindings = [];

    /** @var array<string, mixed> */
    protected array $instances = [];

    /**
     * Bind a service into the container.
     *
     * @param string $key
     * @param mixed $resolver Closure, class name, or ready instance
     * @param bool $singleton Whether to cache a single instance
     */
    public function bind(string $key, $resolver, bool $singleton = false): void
    {
        $this->bindings[$key] = ['resolver' => $resolver, 'singleton' => $singleton];
        unset($this->instances[$key]);
    }

    /** Register a singleton service. */
    public function singleton(string $key, $resolver): void
    {
        $this->bind($key, $resolver, true);
    }

    /** Check if a binding or instance exists. */
    public function has(string $id): bool
    {
        return isset($this->bindings[$id]) || isset($this->instances[$id]) || class_exists($id);
    }

    /** Retrieve a service by id or class name. */
    public function get(string $id)
    {
        // Already built?
        if (isset($this->instances[$id])) {
            return $this->instances[$id];
        }

        // Bound explicitly?
        if (isset($this->bindings[$id])) {
            $binding = $this->bindings[$id];
            $resolver = $binding['resolver'];

            if ($resolver instanceof Closure) {
                $object = $resolver($this);
            } elseif (is_string($resolver) && class_exists($resolver)) {
                $object = $this->build($resolver);
            } else {
                // literal instance
                $object = $resolver;
            }

            if ($binding['singleton']) {
                $this->instances[$id] = $object;
            }

            return $object;
        }

        // Try autowiring
        if (class_exists($id)) {
            return $this->build($id);
        }

        throw new \RuntimeException("Container: No entry or class found for '{$id}'");
    }

    /** Build a class via Reflection (autowire constructor dependencies). */
    public function build(string $class)
    {
        $reflector = new ReflectionClass($class);
        if (!$reflector->isInstantiable()) {
            throw new \RuntimeException("Class {$class} is not instantiable");
        }

        $constructor = $reflector->getConstructor();
        if ($constructor === null) {
            return new $class;
        }

        $params = $constructor->getParameters();
        $dependencies = array_map(fn($p) => $this->resolveParameter($p), $params);

        return $reflector->newInstanceArgs($dependencies);
    }

    /** Resolve constructor parameters recursively. */
    protected function resolveParameter(ReflectionParameter $param)
    {
        $type = $param->getType();
        if ($type && !$type->isBuiltin()) {
            $typeName = $type->getName();
            return $this->get($typeName);
        }

        if ($param->isDefaultValueAvailable()) {
            return $param->getDefaultValue();
        }

        throw new \RuntimeException("Unable to resolve parameter \${$param->getName()}");
    }

}



