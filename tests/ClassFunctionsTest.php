<?php

namespace Jasny;

use Jasny\PhpFunctions\TestClass;

require __DIR__ . '/support/TestClass.php';

/**
 * Test class functions
 */
class ClassFunctionsTest extends \PHPUnit_Framework_TestCase
{
    protected $object;
    
    /**
     * Set up befor each test
     */
    public function setUp()
    {
        $this->object = new TestClass();
    }
    
    /**
     * Test get_private_property
     */
    public function testGetPrivateProperty()
    {
        $this->assertSame(10, get_private_property($this->object, 'priv'));
        $this->assertSame(20, get_private_property($this->object, 'prot'));
        $this->assertSame(40, get_private_property($this->object, 'pub'));
    }
    
    /**
     * Test get_private_property with a static property
     */
    public function testGetPrivateProperty_Static()
    {
        $this->assertSame(910, get_private_property(TestClass::class, 'statPriv'));
        $this->assertSame(920, get_private_property(TestClass::class, 'statProt'));
        $this->assertSame(940, get_private_property(TestClass::class, 'statPub'));
    }
    
    /**
     * Test get_private_property for a non-existing property
     * 
     * @expectedException ReflectionException
     * @expectedExceptionMessage Property non_exist does not exist
     */
    public function testGetPrivateProperty_Fail()
    {
        get_private_property($this->object, 'non_exist');
    }
    
    /**
     * Test get_private_property for a non-existing static property
     * 
     * @expectedException ReflectionException
     * @expectedExceptionMessage Property non_exist does not exist
     */
    public function testGetPrivateProperty_Static_Fail()
    {
        get_private_property(TestClass::class, 'non_exist');
    }

    
    /**
     * Test call_private_method
     */
    public function testCallPrivateMethod()
    {
        $this->assertSame('priv-cab', call_private_method($this->object, 'privfn', 'a', 'b', 'c'));
        $this->assertSame('prot-cab', call_private_method($this->object, 'protfn', 'a', 'b', 'c'));
        $this->assertSame('pub-cab', call_private_method($this->object, 'pubfn', 'a', 'b', 'c'));
    }
    
    /**
     * Test call_private_method for static methods
     */
    public function testCallPrivateMethod_Static()
    {
        $this->assertSame('stat-priv-cab', call_private_method(TestClass::class, 'statPrivfn', 'a', 'b', 'c'));
        $this->assertSame('stat-prot-cab', call_private_method(TestClass::class, 'statProtfn', 'a', 'b', 'c'));
        $this->assertSame('stat-pub-cab', call_private_method(TestClass::class, 'statPubfn', 'a', 'b', 'c'));
    }
    
    /**
     * Test get_private_method for a non-existing method
     * 
     * @expectedException ReflectionException
     * @expectedExceptionMessage Method non_exist does not exist
     */
    public function testCallPrivateMethod_Fail()
    {
        call_private_method($this->object, 'non_exist');
    }
    
    /**
     * Test get_private_property for a non-existing static method
     * 
     * @expectedException ReflectionException
     * @expectedExceptionMessage Method non_exist does not exist
     */
    public function testCallPrivateMethod_Static_Fail()
    {
        call_private_method(TestClass::class, 'non_exist');
    }
    
    
    /**
     * Test call_private_method_array
     */
    public function testCallPrivateMethodArray()
    {
        $this->assertSame('priv-cab', call_private_method_array($this->object, 'privfn', ['a', 'b', 'c']));
        $this->assertSame('prot-cab', call_private_method_array($this->object, 'protfn', ['a', 'b', 'c']));
        $this->assertSame('pub-cab', call_private_method_array($this->object, 'pubfn', ['a', 'b', 'c']));
    }
    
    /**
     * Test call_private_method_array for static methods
     */
    public function testCallPrivateMethodArray_Static()
    {
        $this->assertSame('stat-priv-cab', call_private_method_array(TestClass::class, 'statPrivfn', ['a', 'b', 'c']));
        $this->assertSame('stat-prot-cab', call_private_method_array(TestClass::class, 'statProtfn', ['a', 'b', 'c']));
        $this->assertSame('stat-pub-cab', call_private_method_array(TestClass::class, 'statPubfn', ['a', 'b', 'c']));
    }
    
    /**
     * Test call_private_method_array for non-existing method
     * 
     * @expectedException ReflectionException
     * @expectedExceptionMessage Method non_exist does not exist
     */
    public function testCallPrivateMethodArray_Fail()
    {
        call_private_method($this->object, 'non_exist');
    }
    
    /**
     * Test call_private_method_array for non-existing static method
     * 
     * @expectedException ReflectionException
     * @expectedExceptionMessage Method non_exist does not exist
     */
    public function testCallPrivateMethodArray_Static_Fail()
    {
        call_private_method(TestClass::class, 'non_exist');
    }
}
