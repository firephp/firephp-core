<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/10-IgnoreInTraces_TestWrapper.php');

class Features_IgnoreInTraces extends TestCase
{

    public function testDefault()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->trace('Trace from here');

        $this->assertEquals(
            $firephp->_getHeader(4),
            '2426|[{"Type":"TRACE","File":"...\/tests\/Features\/10-IgnoreInTraces.php","Line":' . (__LINE__-4) . '},{"Class":"FirePHP","Type":"->","Function":"trace","Message":"Trace from here","File":"...\/tests\/Features\/10-IgnoreInTraces.php","Line":15,"Args":["Trace from here"],"Trace":[{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestCase.php","line":1327,"function":"testDefault","class":"Features_IgnoreInTraces","object":{},"type":"->","args":[]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestCase.php","line":947,"function":"runTest","class":"PHPUnit\\\\Framework\\\\TestCase","object":{},"type":"->","args":[]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestResult.php","line":691,"function":"runBare","class":"PHPUnit\\\\Framework\\\\TestCase","object":{},"type":"->","args":[]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestCase.php","line":679,"function":"run","class":"PHPUnit\\\\Framework\\\\TestResult","object":{},"type":"->","args":[{"__className":"Features_IgnoreInTraces"}]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestSuite.php","line":568,"function":"run","class":"PHPUnit\\\\Framework\\\\TestCase","object":{},"type":"->","args":[{"__className":"PHPUnit\\\\Framework\\\\TestResult"}]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestSuite.php","line":568,"function":"run","class":"PHPUnit\\\\Framework\\\\TestSuite","object":{},"type":"->","args":[{"__className":"PHPUnit\\\\Framework\\\\TestResult"}]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestSuite.php","line":568,"function":"run","class":"PHPUnit\\\\Framework\\\\TestSuite","object":{},"type":"->","args":[{"__className":"PHPUnit\\\\Framework\\\\TestResult"}]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/TextUI\/TestRunner.php","line":616,"function":"run","class":"PHPUnit\\\\Framework\\\\TestSuite","object":{},"type":"->","args":[{"__className":"PHPUnit\\\\Framework\\\\TestResult"}]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/TextUI\/Command.php","line":201,"function":"doRun","class":"PHPUnit\\\\TextUI\\\\TestRunner","object":{},"type":"->","args":{"0":{"__className":"PHPUnit\\\\Framework\\\\TestSuite"},"2":true}},{"file":"...\/vendor\/phpunit\/phpunit\/src\/TextUI\/Command.php","line":160,"function":"run","class":"PHPUnit\\\\TextUI\\\\Command","object":{},"type":"->","args":{"1":true}},{"file":"...\/vendor\/phpunit\/phpunit\/phpunit","line":61,"function":"main","class":"PHPUnit\\\\TextUI\\\\Command","type":"::","args":[]}]}]|'
        );
    }

    public function testDefaultWrapper()
    {
        $firephp = new MyFirePHPWrapper2();

        $firephp->mytrace('Trace from here');

        $this->assertEquals(
            $firephp->_getHeader(4),
            '2620|[{"Type":"TRACE","File":"...\/tests\/Features\/10-IgnoreInTraces_TestWrapper.php","Line":7},{"Class":"FirePHP","Type":"->","Function":"trace","Message":"Trace from here","File":"...\/tests\/Features\/10-IgnoreInTraces_TestWrapper.php","Line":7,"Args":["Trace from here"],"Trace":[{"file":"...\/tests\/Features\/10-IgnoreInTraces.php","line":' . (__LINE__-4) . ',"function":"mytrace","class":"MyFirePHPWrapper2","object":{},"type":"->","args":["Trace from here"]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestCase.php","line":1327,"function":"testDefaultWrapper","class":"Features_IgnoreInTraces","object":{},"type":"->","args":[]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestCase.php","line":947,"function":"runTest","class":"PHPUnit\\\\Framework\\\\TestCase","object":{},"type":"->","args":[]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestResult.php","line":691,"function":"runBare","class":"PHPUnit\\\\Framework\\\\TestCase","object":{},"type":"->","args":[]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestCase.php","line":679,"function":"run","class":"PHPUnit\\\\Framework\\\\TestResult","object":{},"type":"->","args":[{"__className":"Features_IgnoreInTraces"}]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestSuite.php","line":568,"function":"run","class":"PHPUnit\\\\Framework\\\\TestCase","object":{},"type":"->","args":[{"__className":"PHPUnit\\\\Framework\\\\TestResult"}]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestSuite.php","line":568,"function":"run","class":"PHPUnit\\\\Framework\\\\TestSuite","object":{},"type":"->","args":[{"__className":"PHPUnit\\\\Framework\\\\TestResult"}]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestSuite.php","line":568,"function":"run","class":"PHPUnit\\\\Framework\\\\TestSuite","object":{},"type":"->","args":[{"__className":"PHPUnit\\\\Framework\\\\TestResult"}]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/TextUI\/TestRunner.php","line":616,"function":"run","class":"PHPUnit\\\\Framework\\\\TestSuite","object":{},"type":"->","args":[{"__className":"PHPUnit\\\\Framework\\\\TestResult"}]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/TextUI\/Command.php","line":201,"function":"doRun","class":"PHPUnit\\\\TextUI\\\\TestRunner","object":{},"type":"->","args":{"0":{"__className":"PHPUnit\\\\Framework\\\\TestSuite"},"2":true}},{"file":"...\/vendor\/phpunit\/phpunit\/src\/TextUI\/Command.php","line":160,"function":"run","class":"PHPUnit\\\\TextUI\\\\Command","object":{},"type":"->","args":{"1":true}},{"file":"...\/vendor\/phpunit\/phpunit\/phpunit","line":61,"function":"main","class":"PHPUnit\\\\TextUI\\\\Command","type":"::","args":[]}]}]|'
        );
    }

    public function testWrapperIgnoreClass()
    {
        $firephp = new MyFirePHPWrapper2();

        $firephp->ignoreClassInTraces('PHPUnit\\Framework\\TestCase');
        $firephp->ignoreClassInTraces('PHPUnit\\Framework\\TestSuite');
        $firephp->ignoreClassInTraces('PHPUnit\TextUI');

        $firephp->mytrace('Trace from here');

        $this->assertEquals(
            $firephp->_getHeader(4),
            '849|[{"Type":"TRACE","File":"...\/tests\/Features\/10-IgnoreInTraces_TestWrapper.php","Line":7},{"Class":"FirePHP","Type":"->","Function":"trace","Message":"Trace from here","File":"...\/tests\/Features\/10-IgnoreInTraces_TestWrapper.php","Line":7,"Args":["Trace from here"],"Trace":[{"file":"...\/tests\/Features\/10-IgnoreInTraces.php","line":' . (__LINE__-4) . ',"function":"mytrace","class":"MyFirePHPWrapper2","object":{},"type":"->","args":["Trace from here"]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestCase.php","line":1327,"function":"testWrapperIgnoreClass","class":"Features_IgnoreInTraces","object":{},"type":"->","args":[]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestCase.php","line":679,"function":"run","class":"PHPUnit\\\\Framework\\\\TestResult","object":{},"type":"->","args":[{"__className":"Features_IgnoreInTraces"}]}]}]|'
        );
    }

    public function testWrapperIgnoreClassWithOffset()
    {
        $firephp = new MyFirePHPWrapper2();

        $firephp->ignoreClassInTraces('PHPUnit\\Framework\\TestCase');
        $firephp->ignoreClassInTraces('PHPUnit\\Framework\\TestSuite');
        $firephp->ignoreClassInTraces('PHPUnit\TextUI');

        $firephp->setOption('lineNumberOffset', 1);

        $firephp->mytrace('Trace from here');

        $this->assertEquals(
            $firephp->_getHeader(4),
            '849|[{"Type":"TRACE","File":"...\/tests\/Features\/10-IgnoreInTraces.php","Line":' . (__LINE__-4) . '},{"Class":"MyFirePHPWrapper2","Type":"->","Function":"mytrace","Message":"Trace from here","File":"...\/tests\/Features\/10-IgnoreInTraces.php","Line":61,"Args":["Trace from here"],"Trace":[{"file":"...\/tests\/Features\/10-IgnoreInTraces.php","line":61,"function":"mytrace","class":"MyFirePHPWrapper2","object":{},"type":"->","args":["Trace from here"]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestCase.php","line":1327,"function":"testWrapperIgnoreClassWithOffset","class":"Features_IgnoreInTraces","object":{},"type":"->","args":[]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestCase.php","line":679,"function":"run","class":"PHPUnit\\\\Framework\\\\TestResult","object":{},"type":"->","args":[{"__className":"Features_IgnoreInTraces"}]}]}]|'
        );
    }
    
    public function testWrapperIgnoreFile()
    {
        $firephp = new MyFirePHPWrapper2();

        $firephp->ignorePathInTraces(substr(__DIR__, 0, strlen(__DIR__) - (5 + 8 + 2)) . '/vendor/phpunit/phpunit/src/Framework/TestCase.php');
        $firephp->ignorePathInTraces(substr(__DIR__, 0, strlen(__DIR__) - (5 + 8 + 2)) . '/vendor/phpunit/phpunit/src/Framework/TestSuite.php');
        $firephp->ignorePathInTraces(substr(__DIR__, 0, strlen(__DIR__) - (5 + 8 + 2)) . '/vendor/phpunit/phpunit/src/Framework/TestResult.php');

        $firephp->mytrace('Trace from here');

        $this->assertEquals(
            $firephp->_getHeader(4),
            '1203|[{"Type":"TRACE","File":"...\/tests\/Features\/10-IgnoreInTraces_TestWrapper.php","Line":7},{"Class":"FirePHP","Type":"->","Function":"trace","Message":"Trace from here","File":"...\/tests\/Features\/10-IgnoreInTraces_TestWrapper.php","Line":7,"Args":["Trace from here"],"Trace":[{"file":"...\/tests\/Features\/10-IgnoreInTraces.php","line":' . (__LINE__-4) . ',"function":"mytrace","class":"MyFirePHPWrapper2","object":{},"type":"->","args":["Trace from here"]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/TextUI\/TestRunner.php","line":616,"function":"run","class":"PHPUnit\\\\Framework\\\\TestSuite","object":{},"type":"->","args":[{"__className":"PHPUnit\\\\Framework\\\\TestResult"}]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/TextUI\/Command.php","line":201,"function":"doRun","class":"PHPUnit\\\\TextUI\\\\TestRunner","object":{},"type":"->","args":{"0":{"__className":"PHPUnit\\\\Framework\\\\TestSuite"},"2":true}},{"file":"...\/vendor\/phpunit\/phpunit\/src\/TextUI\/Command.php","line":160,"function":"run","class":"PHPUnit\\\\TextUI\\\\Command","object":{},"type":"->","args":{"1":true}},{"file":"...\/vendor\/phpunit\/phpunit\/phpunit","line":61,"function":"main","class":"PHPUnit\\\\TextUI\\\\Command","type":"::","args":[]}]}]|'
        );
    }

    public function testWrapperIgnoreDirectory()
    {
        $firephp = new MyFirePHPWrapper2();

        $firephp->ignorePathInTraces(substr(__DIR__, 0, strlen(__DIR__) - (5 + 8 + 2)) . '/vendor/phpunit/phpunit/src/Framework/');

        $firephp->mytrace('Trace from here');

        $this->assertEquals(
            $firephp->_getHeader(4),
            '1203|[{"Type":"TRACE","File":"...\/tests\/Features\/10-IgnoreInTraces_TestWrapper.php","Line":7},{"Class":"FirePHP","Type":"->","Function":"trace","Message":"Trace from here","File":"...\/tests\/Features\/10-IgnoreInTraces_TestWrapper.php","Line":7,"Args":["Trace from here"],"Trace":[{"file":"...\/tests\/Features\/10-IgnoreInTraces.php","line":' . (__LINE__-4) . ',"function":"mytrace","class":"MyFirePHPWrapper2","object":{},"type":"->","args":["Trace from here"]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/TextUI\/TestRunner.php","line":616,"function":"run","class":"PHPUnit\\\\Framework\\\\TestSuite","object":{},"type":"->","args":[{"__className":"PHPUnit\\\\Framework\\\\TestResult"}]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/TextUI\/Command.php","line":201,"function":"doRun","class":"PHPUnit\\\\TextUI\\\\TestRunner","object":{},"type":"->","args":{"0":{"__className":"PHPUnit\\\\Framework\\\\TestSuite"},"2":true}},{"file":"...\/vendor\/phpunit\/phpunit\/src\/TextUI\/Command.php","line":160,"function":"run","class":"PHPUnit\\\\TextUI\\\\Command","object":{},"type":"->","args":{"1":true}},{"file":"...\/vendor\/phpunit\/phpunit\/phpunit","line":61,"function":"main","class":"PHPUnit\\\\TextUI\\\\Command","type":"::","args":[]}]}]|'
        );
    }
}
