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

    
    static private $statPriv = 910;

    static private $statProt = 920;

    static private $statPub = 940;
    
    static private function statPrivfn($s1, $s2, $s3)
    {
        return 'stat-priv-' . $s3 . $s1 . $s2;
    }
    
    static protected function statProtfn($s1, $s2, $s3)
    {
        return 'stat-prot-' . $s3 . $s1 . $s2;
    }
    
    static public function statPubfn($s1, $s2, $s3)
    {
        return 'stat-pub-' . $s3 . $s1 . $s2;
    }
}
