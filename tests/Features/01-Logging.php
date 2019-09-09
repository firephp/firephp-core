<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class Features_Logging extends TestCase
{
    public function testHelloWorld()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->log('Hello World');

        $this->assertEquals(
            $firephp->_getHeader(4),
            '86|[{"Type":"LOG","File":"...\/tests\/Features\/01-Logging.php","Line":' . (__LINE__-4) .  '},"Hello World"]|'
        );
    }

    public function testLog()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->log('Log Message');

        $this->assertEquals(
            $firephp->_getHeader(4),
            '86|[{"Type":"LOG","File":"...\/tests\/Features\/01-Logging.php","Line":' . (__LINE__-4) .  '},"Log Message"]|'
        );
    }

    public function testInfo()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->info('Info Message');

        $this->assertEquals(
            $firephp->_getHeader(4),
            '88|[{"Type":"INFO","File":"...\/tests\/Features\/01-Logging.php","Line":' . (__LINE__-4) .  '},"Info Message"]|'
        );
    }

    public function testWarn()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->warn('Warning Message');

        $this->assertEquals(
            $firephp->_getHeader(4),
            '91|[{"Type":"WARN","File":"...\/tests\/Features\/01-Logging.php","Line":' . (__LINE__-4) .  '},"Warning Message"]|'
        );
    }

    public function testError()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->error('Error Message');

        $this->assertEquals(
            $firephp->_getHeader(4),
            '90|[{"Type":"ERROR","File":"...\/tests\/Features\/01-Logging.php","Line":' . (__LINE__-4) .  '},"Error Message"]|'
        );
    }

    public function testTrace()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->trace('Trace from here');

        $this->assertEquals(
            $firephp->_getHeader(4),
            '2396|[{"Type":"TRACE","File":"...\/tests\/Features\/01-Logging.php","Line":' . (__LINE__-4) . '},{"Class":"FirePHP","Type":"->","Function":"trace","Message":"Trace from here","File":"...\/tests\/Features\/01-Logging.php","Line":72,"Args":["Trace from here"],"Trace":[{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestCase.php","line":1327,"function":"testTrace","class":"Features_Logging","object":{},"type":"->","args":[]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestCase.php","line":947,"function":"runTest","class":"PHPUnit\\\\Framework\\\\TestCase","object":{},"type":"->","args":[]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestResult.php","line":691,"function":"runBare","class":"PHPUnit\\\\Framework\\\\TestCase","object":{},"type":"->","args":[]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestCase.php","line":679,"function":"run","class":"PHPUnit\\\\Framework\\\\TestResult","object":{},"type":"->","args":[{"__className":"Features_Logging"}]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestSuite.php","line":568,"function":"run","class":"PHPUnit\\\\Framework\\\\TestCase","object":{},"type":"->","args":[{"__className":"PHPUnit\\\\Framework\\\\TestResult"}]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestSuite.php","line":568,"function":"run","class":"PHPUnit\\\\Framework\\\\TestSuite","object":{},"type":"->","args":[{"__className":"PHPUnit\\\\Framework\\\\TestResult"}]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestSuite.php","line":568,"function":"run","class":"PHPUnit\\\\Framework\\\\TestSuite","object":{},"type":"->","args":[{"__className":"PHPUnit\\\\Framework\\\\TestResult"}]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/TextUI\/TestRunner.php","line":616,"function":"run","class":"PHPUnit\\\\Framework\\\\TestSuite","object":{},"type":"->","args":[{"__className":"PHPUnit\\\\Framework\\\\TestResult"}]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/TextUI\/Command.php","line":201,"function":"doRun","class":"PHPUnit\\\\TextUI\\\\TestRunner","object":{},"type":"->","args":{"0":{"__className":"PHPUnit\\\\Framework\\\\TestSuite"},"2":true}},{"file":"...\/vendor\/phpunit\/phpunit\/src\/TextUI\/Command.php","line":160,"function":"run","class":"PHPUnit\\\\TextUI\\\\Command","object":{},"type":"->","args":{"1":true}},{"file":"...\/vendor\/phpunit\/phpunit\/phpunit","line":61,"function":"main","class":"PHPUnit\\\\TextUI\\\\Command","type":"::","args":[]}]}]|'
        );

        $firephp->fb('Trace from here', FirePHP::TRACE);

        $this->assertEquals(
            $firephp->_getHeader(6),
            '2401|[{"Type":"TRACE","File":"...\/tests\/Features\/01-Logging.php","Line":' . (__LINE__-4) . '},{"Class":"FirePHP","Type":"->","Function":"fb","Message":"Trace from here","File":"...\/tests\/Features\/01-Logging.php","Line":79,"Args":["Trace from here","TRACE"],"Trace":[{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestCase.php","line":1327,"function":"testTrace","class":"Features_Logging","object":{},"type":"->","args":[]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestCase.php","line":947,"function":"runTest","class":"PHPUnit\\\\Framework\\\\TestCase","object":{},"type":"->","args":[]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestResult.php","line":691,"function":"runBare","class":"PHPUnit\\\\Framework\\\\TestCase","object":{},"type":"->","args":[]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestCase.php","line":679,"function":"run","class":"PHPUnit\\\\Framework\\\\TestResult","object":{},"type":"->","args":[{"__className":"Features_Logging"}]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestSuite.php","line":568,"function":"run","class":"PHPUnit\\\\Framework\\\\TestCase","object":{},"type":"->","args":[{"__className":"PHPUnit\\\\Framework\\\\TestResult"}]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestSuite.php","line":568,"function":"run","class":"PHPUnit\\\\Framework\\\\TestSuite","object":{},"type":"->","args":[{"__className":"PHPUnit\\\\Framework\\\\TestResult"}]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestSuite.php","line":568,"function":"run","class":"PHPUnit\\\\Framework\\\\TestSuite","object":{},"type":"->","args":[{"__className":"PHPUnit\\\\Framework\\\\TestResult"}]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/TextUI\/TestRunner.php","line":616,"function":"run","class":"PHPUnit\\\\Framework\\\\TestSuite","object":{},"type":"->","args":[{"__className":"PHPUnit\\\\Framework\\\\TestResult"}]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/TextUI\/Command.php","line":201,"function":"doRun","class":"PHPUnit\\\\TextUI\\\\TestRunner","object":{},"type":"->","args":{"0":{"__className":"PHPUnit\\\\Framework\\\\TestSuite"},"2":true}},{"file":"...\/vendor\/phpunit\/phpunit\/src\/TextUI\/Command.php","line":160,"function":"run","class":"PHPUnit\\\\TextUI\\\\Command","object":{},"type":"->","args":{"1":true}},{"file":"...\/vendor\/phpunit\/phpunit\/phpunit","line":61,"function":"main","class":"PHPUnit\\\\TextUI\\\\Command","type":"::","args":[]}]}]|'
        );
    }

    public function testException()
    {
        $firephp = new FirePHP_TestWrapper();

        function test ($Arg1) {
            throw new Exception('Test Exception');
        }
        try {
            test(array('Hello'=>'World'));
        } catch(Exception $e) {
            $firephp->error($e);
        }

        $this->assertEquals(
            $firephp->_getHeader(4),
            '2347|[{"Type":"EXCEPTION","File":"...\/tests\/Features\/01-Logging.php","Line":' . (__LINE__-10) . '},{"Class":"Exception","Message":"Test Exception","File":"...\/tests\/Features\/01-Logging.php","Line":' . (__LINE__-10) . ',"Type":"throw","Trace":[{"file":"...\/tests\/Features\/01-Logging.php","line":' . (__LINE__-7) . ',"function":"test","args":"** Max Depth (1) **"},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestCase.php","line":1327,"function":"testException","class":"Features_Logging","type":"->","args":[]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestCase.php","line":947,"function":"runTest","class":"PHPUnit\\\\Framework\\\\TestCase","type":"->","args":[]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestResult.php","line":691,"function":"runBare","class":"PHPUnit\\\\Framework\\\\TestCase","type":"->","args":[]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestCase.php","line":679,"function":"run","class":"PHPUnit\\\\Framework\\\\TestResult","type":"->","args":[{"__className":"Features_Logging"}]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestSuite.php","line":568,"function":"run","class":"PHPUnit\\\\Framework\\\\TestCase","type":"->","args":[{"__className":"PHPUnit\\\\Framework\\\\TestResult"}]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestSuite.php","line":568,"function":"run","class":"PHPUnit\\\\Framework\\\\TestSuite","type":"->","args":[{"__className":"PHPUnit\\\\Framework\\\\TestResult"}]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/Framework\/TestSuite.php","line":568,"function":"run","class":"PHPUnit\\\\Framework\\\\TestSuite","type":"->","args":[{"__className":"PHPUnit\\\\Framework\\\\TestResult"}]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/TextUI\/TestRunner.php","line":616,"function":"run","class":"PHPUnit\\\\Framework\\\\TestSuite","type":"->","args":[{"__className":"PHPUnit\\\\Framework\\\\TestResult"}]},{"file":"...\/vendor\/phpunit\/phpunit\/src\/TextUI\/Command.php","line":201,"function":"doRun","class":"PHPUnit\\\\TextUI\\\\TestRunner","type":"->","args":{"0":{"__className":"PHPUnit\\\\Framework\\\\TestSuite"},"2":true}},{"file":"...\/vendor\/phpunit\/phpunit\/src\/TextUI\/Command.php","line":160,"function":"run","class":"PHPUnit\\\\TextUI\\\\Command","type":"->","args":{"1":true}},{"file":"...\/vendor\/phpunit\/phpunit\/phpunit","line":61,"function":"main","class":"PHPUnit\\\\TextUI\\\\Command","type":"::","args":[]}]}]|'
        );
    }

    public function testTable()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->table('Sample table', array(
            array('Name', 'Value'),
            array('String', 'Sample String'),
            array('Array', array('Sample', 'Array')),
            array('Integer', 1),
            array('Boolean', true),
            array('Null', null)
        ));

        $this->assertEquals(
            $firephp->_getHeader(4),
            '218|[{"Type":"TABLE","Label":"Sample table","File":"...\/tests\/Features\/01-Logging.php","Line":' . (__LINE__-10) . '},[["Name","Value"],["String","Sample String"],["Array",["Sample","Array"]],["Integer",1],["Boolean",true],["Null",null]]]|'
        );
    }
}
