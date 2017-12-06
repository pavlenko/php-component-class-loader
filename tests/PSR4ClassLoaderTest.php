<?php

namespace PETest\Component\ClassLoader;

use PE\Component\ClassLoader\PSR4ClassLoader;

class PSR4ClassLoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $className
     *
     * @dataProvider getExistsClasses
     */
    public function testLoadExistsClass($className)
    {
        $loader = new PSR4ClassLoader();
        $loader->add('Acme\\DemoLib', __DIR__ . '/TestAsset/psr-4');
        $loader->loadClass($className);

        static::assertTrue(class_exists($className));
    }

    /**
     * @return array
     */
    public function getExistsClasses()
    {
        return array(
            array('Acme\\DemoLib\\Foo'),
            array('Acme\\DemoLib\\Class_With_Underscores'),
            array('Acme\\DemoLib\\Lets\\Go\\Deeper\\Foo'),
            array('Acme\\DemoLib\\Lets\\Go\\Deeper\\Class_With_Underscores'),
        );
    }

    /**
     * @param $className
     *
     * @dataProvider getNonExistsClasses
     */
    public function testLoadNonExistsClass($className)
    {
        $loader = new PSR4ClassLoader();
        $loader->add('Acme\\DemoLib', __DIR__ . '/TestAsset/psr-4');
        $loader->loadClass($className);

        static::assertFalse(class_exists($className));
    }

    /**
     * @return array
     */
    public function getNonExistsClasses()
    {
        return array(
            array('Acme\\DemoLib\\I_Do_Not_Exist'),
            array('UnknownVendor\\SomeLib\\I_Do_Not_Exist'),
        );
    }
}
