<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class Features_RecursiveEncoding extends TestCase
{
    public function testRecursiveEncode()
    {
        $firephp = new FirePHP_TestWrapper();
/*
// defaults
$this->assertEquals(5, $firephp->getOption("maxObjectDepth"));
$this->assertEquals(5, $firephp->getOption("maxArrayDepth"));
$this->assertEquals(true, $firephp->getOption("useNativeJsonEncode"));
$this->assertEquals(true, $firephp->getOption("includeLineNumbers"));
*/
    }
}
