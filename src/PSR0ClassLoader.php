<?php

namespace PE\Component\ClassLoader;

/**
 * ClassLoader implements an PSR-0 class loader.
 */
class PSR0ClassLoader extends ClassLoaderAbstract
{
    /**
     * @inheritdoc
     */
    public function findFile($class)
    {
        $class = ltrim($class, '\\');

        if (false !== $pos = strrpos($class, '\\')) {
            // namespaced class name
            $classPath = str_replace('\\', DIRECTORY_SEPARATOR, substr($class, 0, $pos)) . DIRECTORY_SEPARATOR;
            $className = substr($class, $pos + 1);
        } else {
            // PEAR-like class name
            $classPath = null;
            $className = $class;
        }

        $classPath .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

        foreach ($this->map as $prefix => $paths) {
            if (0 === strpos($class, $prefix)) {
                foreach ((array) $paths as $path) {
                    $file = $path . DIRECTORY_SEPARATOR . $classPath;

                    if (file_exists($file)) {
                        return $file;
                    }
                }
            }
        }

        return null;
    }
}