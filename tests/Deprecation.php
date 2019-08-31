<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class Deprecation extends TestCase
{    
    public function testDeprecatedMethods()
    {
        $firephp = new FirePHP_TestWrapper();

        $caught = false;
        try {
            $firephp->setProcessorUrl('URL');
        } catch(Exception $e) {
            $caught = true;
            $this->assertEquals(E_USER_DEPRECATED, $e->getCode());
            $this->assertEquals('The FirePHP::setProcessorUrl() method is no longer supported', $e->getMessage());
        }
        if(!$caught) $this->fail('No deprecation error thrown');

        $caught = false;
        try {
            $firephp->setRendererUrl('URL');
        } catch(Exception $e) {
            $caught = true;
            $this->assertEquals(E_USER_DEPRECATED, $e->getCode());
            $this->assertEquals('The FirePHP::setRendererUrl() method is no longer supported', $e->getMessage());
        }
        if(!$caught) $this->fail('No deprecation error thrown');
    }     
}
