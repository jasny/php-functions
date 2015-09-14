<?php

namespace Jasny\PhpFunctions;

/**
 * Test class for class functions
 */
class TestClass
{
    private $priv = 10;
    
    protected $prot = 20;
    
    public $pub = 40;
    
    
    private function privfn($s1, $s2, $s3)
    {
        return 'priv-' . $s3 . $s1 . $s2;
    }
    
    protected function protfn($s1, $s2, $s3)
    {
        return 'prot-' . $s3 . $s1 . $s2;
    }
    
    public function pubfn($s1, $s2, $s3)
    {
        return 'pub-' . $s3 . $s1 . $s2;
    }
}
