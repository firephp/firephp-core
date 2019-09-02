<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class Features_Dumping extends TestCase
{
    public function testDumpString()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->dump('Key', 'Hello World');

        $this->assertEquals($firephp->_getHeader(4), '21|{"Key":"Hello World"}|');
    }

    public function testDumpArray()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->dump('Key', Array(
            'Key' => 'Hello World'
        ));

        $this->assertEquals($firephp->_getHeader(4), '29|{"Key":{"Key":"Hello World"}}|');
    }
}
