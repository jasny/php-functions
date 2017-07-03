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
     * @covers Jasny\call_user_func_named_array
     * 
     * @param string $expect
     * @param array  $args
     */
    public function testCallUserFuncNamedArrayStrReplace($expect, array $args)
    {
        $this->assertEquals($expect, call_user_func_named_array('str_replace', $args));
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
     * @covers Jasny\call_user_func_named_array
     * 
     * @param string $expect
     * @param array  $args
     */
    public function testCallUserFuncNamedArrayStrTr($expect, array $args)
    {
        $this->assertEquals($expect, call_user_func_named_array('strtr', $args));
    }
    
    /**
     * @covers Jasny\call_user_func_named_array
     */
    public function testCallUserFuncNamedArrayDateTime()
    {
        $date = new \DateTime("2017-01-02T00:00:00+0000");
        $this->assertEquals('2017-01-02', call_user_func_named_array([$date, 'format'], ['format' => 'Y-m-d']));
    }

    
    /**
     * @covers Jasny\call_user_func_named_array
     * 
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Missing argument 'search' for str_replace()
     */
    public function testCallUserFuncNamedArrayStrReplaceInvalid()
    {
        call_user_func_named_array('str_replace', ['subject' => 'foo', 'replace' => 'o']);
    }
    
    /**
     * @covers Jasny\call_user_func_named_array
     * 
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Missing argument 'format' for DateTime::format()
     */
    public function testCallUserFuncNamedArrayDateTimeInvalid()
    {
        $date = new \DateTime("2017-01-02T00:00:00+0000");
        call_user_func_named_array([$date, 'format'], []);
    }
}
