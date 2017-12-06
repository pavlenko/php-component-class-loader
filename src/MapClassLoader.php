<?php

namespace PE\Component\ClassLoader;

/**
 * ClassLoader implements static class map loader.
 */
class MapClassLoader extends ClassLoaderAbstract
{
    /**
     * @inheritDoc
     */
    public function findFile($class)
    {
        return isset($this->map[$class][0]) ? $this->map[$class][0] : null;
    }
}