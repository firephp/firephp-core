<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class Features_FB extends TestCase
{

    public function testFunctionInterface()
    {
        // TODO: Intercept fb logging calls.

        $info = new ReflectionFunction('fb');

        $this->assertEquals(
            $info->name,
            'fb'
        );
    }

    public function testClassInterface()
    {
        // TODO: Test interface more thoroughly.
        // TODO: Intercept FB logging calls.

        $reflectionClass = new ReflectionClass('FB');
        $names = array();
        foreach ($reflectionClass->getMethods() as $method) {
            array_push($names, $method->name);
        }

        $this->assertEquals(
            json_encode($names),
            '["setLogToInsightConsole","setEnabled","getEnabled","setObjectFilter","setOptions","getOptions","send","group","groupEnd","log","info","warn","error","dump","trace","table"]'
        );
    }
}
