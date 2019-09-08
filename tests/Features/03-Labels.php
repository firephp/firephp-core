<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class Features_Labels extends TestCase
{
    public function testLogLabel()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->log('Hello World', 'Label');

        $this->assertEquals(
            $firephp->_getHeader(4),
            '101|[{"Type":"LOG","Label":"Label","File":"...\/tests\/Features\/03-Labels.php","Line":' . (__LINE__-4) . '},"Hello World"]|'
        );
    }
}
