<?php

namespace PE\Component\ClassLoader;

/**
 * Base auto-loader logic
 */
abstract class ClassLoaderAbstract
{
    /**
     * @var array[]
     */
    protected $map = [];

    /**
     * Add class mapping
     *
     * @param string|array $prefix
     * @param string|array $paths
     */
    final public function add($prefix, $paths)
    {
        if (isset($this->map[$prefix])) {
            if (is_array($paths)) {
                $this->map[$prefix] = array_unique(array_merge(
                    $this->map[$prefix],
                    $paths
                ));
            } else if (!in_array($paths, $this->map[$prefix], true)) {
                $this->map[$prefix][] = $paths;
            }
        } else {
            $this->map[$prefix] = array_unique((array) $paths);
        }
    }

    /**
     * @return array[]
     */
    final public function getMap()
    {
        return $this->map;
    }

    /**
     * @param string $class
     *
     * @return bool
     */
    final public function loadClass($class)
    {
        $file = $this->findFile($class);

        if (null !== $file) {
            class_loader_scope_isolated_include_function($file);
            return true;
        }

        return false;
    }

    /**
     * @param string $class
     *
     * @return string|null
     */
    abstract public function findFile($class);

    /**
     * Registers this instance as an auto-loader.
     *
     * @param bool $prepend
     *
     * @codeCoverageIgnore
     */
    final public function register($prepend = false)
    {
        spl_autoload_register(array($this, 'loadClass'), true, $prepend);
    }

    /**
     * Unregisters this instance as an auto-loader.
     *
     * @codeCoverageIgnore
     */
    final public function unregister()
    {
        spl_autoload_unregister(array($this, 'loadClass'));
    }
}

/**
 * Scope isolated include.
 *
 * Prevents access to $this/self from included files.
 */
function class_loader_scope_isolated_include_function($file)
{
    include $file;
}