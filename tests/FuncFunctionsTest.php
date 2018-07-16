<?php

namespace Jasny;

/**
 * Test function handling functions
 */
class FuncFunctionsTest extends \PHPUnit_Framework_TestCase
{
    public function strReplaceNamedArgProvider()
    {
        return [
            ['bablamas blamo coblam', ['subject' => 'bananas nano conan', 'search' => 'nan', 'replace' => 'blam']],
            ['bablamas blamo coblam', ['search' => 'nan', 'subject' => 'bananas nano conan', 'replace' => 'blam']],
            ['bablamas blamo coblam', ['replace' => 'blam', 'search' => 'nan', 'subject' => 'bananas nano conan']]
        ];
    }
    
    /**
     * @dataProvider strReplaceNamedArgProvider
     * @covers Jasny\call_user_func_assoc
     * 
     * @param string $expect
     * @param array  $args
     */
    public function testCallUserFuncAssocStrReplace($expect, array $args)
    {
        $this->assertEquals($expect, call_user_func_assoc('str_replace', $args));
    }
    
    public function strTrNamedArgProvider()
    {
        return [
            ['yzywyzyny', ['str' => 'abawabana', 'from' => 'ab', 'to' => 'yz']],
            ['yzywyzyny', ['str' => 'abawabana', 'from' => ['a' => 'y', 'b' => 'z']]],
        ];
    }
    
    /**
     * @dataProvider strTrNamedArgProvider
     * @covers Jasny\call_user_func_assoc
     * 
     * @param string $expect
     * @param array  $args
     */
    public function testCallUserFuncAssocStrTr($expect, array $args)
    {
        $this->assertEquals($expect, call_user_func_assoc('strtr', $args));
    }
    
    /**
     * @covers Jasny\call_user_func_assoc
     */
    public function testCallUserFuncAssocDateTime()
    {
        $date = new \DateTime("2017-01-02T00:00:00+0000");
        $this->assertEquals('2017-01-02', call_user_func_assoc([$date, 'format'], ['format' => 'Y-m-d']));
    }

    
    /**
     * @covers Jasny\call_user_func_assoc
     * 
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Missing argument 'search' for str_replace()
     */
    public function testCallUserFuncAssocStrReplaceInvalid()
    {
        call_user_func_assoc('str_replace', ['subject' => 'foo', 'replace' => 'o']);
    }
    
    /**
     * @covers Jasny\call_user_func_assoc
     * 
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Missing argument 'format' for DateTime::format()
     */
    public function testCallUserFuncAssocDateTimeInvalid()
    {
        $date = new \DateTime("2017-01-02T00:00:00+0000");
        call_user_func_assoc([$date, 'format'], []);
    }


    /**
     * @covers Jasny\call_user_func_named_array
     */
    public function testCallUserFuncNamedArray()
    {
        $date = new \DateTime("2017-01-02T00:00:00+0000");
        $this->assertEquals('2017-01-02', call_user_func_named_array([$date, 'format'], ['format' => 'Y-m-d']));
    }
}
