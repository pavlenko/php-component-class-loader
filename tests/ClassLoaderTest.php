<?php

namespace PETest\Component\ClassLoader;

use PE\Component\ClassLoader\ClassLoaderAbstract;

class ClassLoaderTest extends \PHPUnit_Framework_TestCase
{
    public function testAdd()
    {
        /* @var $loader ClassLoaderAbstract */
        $loader = $this->createMock(ClassLoaderAbstract::class);
        $loader->add('Foo', 'path1');
        $loader->add('Foo', 'path2');
        $loader->add('Foo', ['path2', 'path2']);

        static::assertSame(['Foo' => ['path1', 'path2']], $loader->getMap());
    }
}
