<?php

namespace Jasny\Tests\Support;

/**
 * @ignore
 */
class FooBar
{
    public $foo = 'woo';

    public $bar = 'BAR';

    protected $qux = 'qqq';

    private $tol = 'lot';

    public function getProperties($dynamic = false)
    {
        return \Jasny\object_get_properties($this, $dynamic);
    }
}

