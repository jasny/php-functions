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
     * Test get_private_property
     * 
     * @expectedException ReflectionException
     * @expectedExceptionMessage Property non_exist does not exist
     */
    public function testGetPrivateProperty_Fail()
    {
        get_private_property($this->object, 'non_exist');
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
     * Test get_private_property
     * 
     * @expectedException ReflectionException
     * @expectedExceptionMessage Method non_exist does not exist
     */
    public function testCallPrivateMethod_Fail()
    {
        call_private_method($this->object, 'non_exist');
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
     * Test get_private_property
     * 
     * @expectedException ReflectionException
     * @expectedExceptionMessage Method non_exist does not exist
     */
    public function testCallPrivateMethodArray_Fail()
    {
        call_private_method($this->object, 'non_exist');
    }
}
