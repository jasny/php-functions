<?php

namespace Jasny;

use Jasny\Tests\Support\FooBar;

/**
 * Test object functions
 */
class ObjectFunctionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Jasny\object_get_properties
     */
    public function testObjectGetProperties()
    {
        $object = new FooBar();

        $this->assertSame(['foo' => 'woo', 'bar' => 'BAR'], object_get_properties($object));
        $this->assertSame(['foo' => 'woo', 'bar' => 'BAR'], $object->getProperties());
    }

    /**
     * @covers Jasny\object_get_properties
     */
    public function testObjectGetPropertiesDynamic()
    {
        $object = new FooBar();
        $object->color = 'red';

        $this->assertSame(['foo' => 'woo', 'bar' => 'BAR', 'color' => 'red'], object_get_properties($object, true));
        $this->assertSame(['foo' => 'woo', 'bar' => 'BAR', 'color' => 'red'], $object->getProperties(true));
    }

    /**
     * @covers Jasny\object_get_properties
     */
    public function testObjectGetPropertiesNotDynamic()
    {
        $object = new FooBar();
        $object->color = 'red';

        $this->assertSame(['foo' => 'woo', 'bar' => 'BAR'], object_get_properties($object, false));
        $this->assertSame(['foo' => 'woo', 'bar' => 'BAR'], $object->getProperties(false));
    }


    /**
     * @covers Jasny\object_set_properties
     */
    public function testObjectSetProperties()
    {
        $object = new FooBar();
        object_set_properties($object, ['foo' => 'cool', 'bar' => 'land']);

        $this->assertAttributeSame('cool', 'foo', $object);
        $this->assertAttributeSame('land', 'bar', $object);
    }

    /**
     * @covers Jasny\object_set_properties
     */
    public function testObjectSetPropertiesDynamic()
    {
        $object = new FooBar();
        object_set_properties($object, ['foo' => 'cool', 'bar' => 'land', 'color' => 'red'], true);

        $this->assertObjectHasAttribute('color', $object);
        $this->assertAttributeSame('red', 'color', $object);
    }

    /**
     * @covers Jasny\object_set_properties
     */
    public function testObjectSetPropertiesNotDynamic()
    {
        $object = new FooBar();
        object_set_properties($object, ['foo' => 'cool', 'bar' => 'land', 'color' => 'red'], false);

        $this->assertObjectNotHasAttribute('color', $object);
    }
}

