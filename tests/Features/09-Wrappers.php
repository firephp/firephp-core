<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class Features_Wrappers extends TestCase
{
    public function testJustSubclass()
    {
        $firephp = new MyFirePHPWrapper();

        $firephp->log('String');

        $this->assertEquals(
            $firephp->_getHeader(4),
            '82|[{"Type":"LOG","File":"...\/tests\/Features\/09-Wrappers.php","Line":' . (__LINE__-4) .  '},"String"]|'
        );
    }

    public function testDefaultOffset()
    {
        $firephp = new MyFirePHPWrapper();

        $firephp->fixDefaultOffset();

        $firephp->mylogger1('String');

        $this->assertEquals(
            $firephp->_getHeader(4),
            '82|[{"Type":"LOG","File":"...\/tests\/Features\/09-Wrappers.php","Line":' . (__LINE__-4) .  '},"String"]|'
        );
    }

    public function testCustomOffset()
    {
        $firephp = new MyFirePHPWrapper();

        $firephp->mylogger2('String');

        $this->assertEquals(
            $firephp->_getHeader(4),
            '82|[{"Type":"LOG","File":"...\/tests\/Features\/09-Wrappers.php","Line":' . (__LINE__-4) .  '},"String"]|'
        );
    }
}


class MyFirePHPWrapper extends FirePHP_TestWrapper {

    public function fixDefaultOffset () {
        $this->setOption('lineNumberOffset', 1);
    }

    public function mylogger1 ($message) {
        return $this->log($message);
    }

    public function mylogger2 ($message) {
        return $this->log($message, null, array(
            'lineNumberOffset' => 1
        ));
    }
}
