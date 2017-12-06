<?php

namespace PE\Component\ClassLoader;

/**
 * ClassLoader implements an PSR-4 class loader.
 */
class PSR4ClassLoader extends ClassLoaderAbstract
{
    /**
     * @inheritdoc
     */
    public function findFile($class)
    {
        $class = ltrim($class, '\\');

        foreach ($this->map as $prefix => $paths) {
            if (0 === strpos($class, $prefix)) {
                $classWithoutPrefix = substr($class, strlen($prefix));

                foreach ((array) $paths as $path) {
                    $file = $path . str_replace('\\', DIRECTORY_SEPARATOR, $classWithoutPrefix) . '.php';

                    if (file_exists($file)) {
                        return $file;
                    }
                }
            }
        }

        return null;
    }
}