<?php

namespace PETest\Component\ClassLoader;

use PE\Component\ClassLoader\MapClassLoader;

class MapClassLoaderTest extends \PHPUnit_Framework_TestCase
{
    public function testLoadExistsClass()
    {
        $loader = new MapClassLoader();
        $loader->add('Foo', __DIR__ . '/TestAsset/map/foo.php');
        $loader->loadClass('Foo');

        static::assertTrue(class_exists('Foo'));
    }

    public function testLoadNonExistsClass()
    {
        $loader = new MapClassLoader();
        $loader->loadClass('NotExists');

        static::assertFalse(class_exists('NotExists'));
    }
}
