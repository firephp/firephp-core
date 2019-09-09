<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class Features_Groups extends TestCase
{

    public function testJustOpen()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->group('Group 1');

        $this->assertEquals(
            $firephp->_getHeader(4),
            '102|[{"Type":"GROUP_START","Label":"Group 1","File":"...\/tests\/Features\/11-Groups.php","Line":' . (__LINE__-4) . '},null]|'
        );
    }

    public function testOpenClose()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->group('Group 1');
        $firephp->groupEnd();

        $this->assertEquals(
            $firephp->_getHeader(4),
            '102|[{"Type":"GROUP_START","Label":"Group 1","File":"...\/tests\/Features\/11-Groups.php","Line":' . (__LINE__-5) . '},null]|'
        );
        $this->assertEquals(
            $firephp->_getHeader(6),
            '82|[{"Type":"GROUP_END","File":"...\/tests\/Features\/11-Groups.php","Line":' . (__LINE__-8) . '},null]|'
        );
    }

    public function testOne()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->group('Group 1');
        $firephp->log('Hello World');
        $firephp->groupEnd();

        $this->assertEquals(
            $firephp->_getHeader(4),
            '102|[{"Type":"GROUP_START","Label":"Group 1","File":"...\/tests\/Features\/11-Groups.php","Line":' . (__LINE__-6) . '},null]|'
        );
        $this->assertEquals(
            $firephp->_getHeader(6),
            '85|[{"Type":"LOG","File":"...\/tests\/Features\/11-Groups.php","Line":' . (__LINE__-9) . '},"Hello World"]|'
        );
        $this->assertEquals(
            $firephp->_getHeader(7),
            '82|[{"Type":"GROUP_END","File":"...\/tests\/Features\/11-Groups.php","Line":' . (__LINE__-12) . '},null]|'
        );
    }

    public function testNested()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->group('Group 1');
        $firephp->log('Hello World 1');

            $firephp->group('Group 2');
            $firephp->log('Hello World 2');
            $firephp->groupEnd();

        $firephp->groupEnd();

        $this->assertEquals(
            $firephp->_getHeader(4),
            '102|[{"Type":"GROUP_START","Label":"Group 1","File":"...\/tests\/Features\/11-Groups.php","Line":' . (__LINE__-11) . '},null]|'
        );
        $this->assertEquals(
            $firephp->_getHeader(6),
            '87|[{"Type":"LOG","File":"...\/tests\/Features\/11-Groups.php","Line":' . (__LINE__-14) . '},"Hello World 1"]|'
        );
        $this->assertEquals(
            $firephp->_getHeader(7),
            '102|[{"Type":"GROUP_START","Label":"Group 2","File":"...\/tests\/Features\/11-Groups.php","Line":' . (__LINE__-16) . '},null]|'
        );
        $this->assertEquals(
            $firephp->_getHeader(8),
            '87|[{"Type":"LOG","File":"...\/tests\/Features\/11-Groups.php","Line":' . (__LINE__-19) . '},"Hello World 2"]|'
        );
        $this->assertEquals(
            $firephp->_getHeader(9),
            '82|[{"Type":"GROUP_END","File":"...\/tests\/Features\/11-Groups.php","Line":' . (__LINE__-22) . '},null]|'
        );
        $this->assertEquals(
            $firephp->_getHeader(10),
            '82|[{"Type":"GROUP_END","File":"...\/tests\/Features\/11-Groups.php","Line":' . (__LINE__-24) . '},null]|'
        );
    }
}
