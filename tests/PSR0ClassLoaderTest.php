<?php

namespace PETest\Component\ClassLoader;

use PE\Component\ClassLoader\PSR0ClassLoader;

class PSR0ClassLoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $className
     *
     * @dataProvider getExistsClasses
     */
    public function testLoadExistsClass($className)
    {
        $loader = new PSR0ClassLoader();
        $loader->add('Namespaced\\', __DIR__ . '/TestAsset/psr-0');
        $loader->add('PearLike_', __DIR__ . '/TestAsset/psr-0');
        $loader->loadClass($className);

        static::assertTrue(class_exists($className));
    }

    /**
     * @return array
     */
    public function getExistsClasses()
    {
        return array(
            array('Namespaced\\Foo'),
            array('PearLike_Foo'),
        );
    }

    /**
     * @param $className
     *
     * @dataProvider getNonExistsClasses
     */
    public function testLoadNonExistsClass($className)
    {
        $loader = new PSR0ClassLoader();
        $loader->add('Namespaced\\', __DIR__ . '/TestAsset/psr-0');
        $loader->add('PearLike_', __DIR__ . '/TestAsset/psr-0');
        $loader->loadClass($className);

        static::assertFalse(class_exists($className));
    }

    /**
     * @return array
     */
    public function getNonExistsClasses()
    {
        return array(
            array('Namespaced\\I_Do_Not_Exist'),
            array('PearLike_I_Do_Not_Exist'),
        );
    }
}
