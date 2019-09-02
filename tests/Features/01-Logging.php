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
            '135|[{"Type":"LOG","File":"...\/tests\/Features\/01-Logging.php","Line":' . (__LINE__-4) .  '},"Hello World"]|'
        );
    }

    public function testLog()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->log('Log Message');

        $this->assertEquals(
            $firephp->_getHeader(4),
            '135|[{"Type":"LOG","File":"...\/tests\/Features\/01-Logging.php","Line":' . (__LINE__-4) .  '},"Log Message"]|'
        );
    }

    public function testInfo()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->info('Info Message');

        $this->assertEquals(
            $firephp->_getHeader(4),
            '137|[{"Type":"INFO","File":"...\/tests\/Features\/01-Logging.php","Line":' . (__LINE__-4) .  '},"Info Message"]|'
        );
    }

    public function testWarn()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->warn('Warning Message');

        $this->assertEquals(
            $firephp->_getHeader(4),
            '140|[{"Type":"WARN","File":"...\/tests\/Features\/01-Logging.php","Line":' . (__LINE__-4) .  '},"Warning Message"]|'
        );
    }

    public function testError()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->error('Error Message');

        $this->assertEquals(
            $firephp->_getHeader(4),
            '139|[{"Type":"ERROR","File":"...\/tests\/Features\/01-Logging.php","Line":' . (__LINE__-4) .  '},"Error Message"]|'
        );
    }
}
