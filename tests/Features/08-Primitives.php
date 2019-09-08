<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class Features_Primitives extends TestCase
{
    public function testString()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->log('String');

        $this->assertEquals(
            $firephp->_getHeader(4),
            '84|[{"Type":"LOG","File":"...\/tests\/Features\/08-Primitives.php","Line":' . (__LINE__-4) .  '},"String"]|'
        );
    }

    public function testUnicodeString()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->log('Что-то');

        $this->assertEquals(
            $firephp->_getHeader(4),
            '109|[{"Type":"LOG","File":"...\/tests\/Features\/08-Primitives.php","Line":' . (__LINE__-4) .  '},"\u0427\u0442\u043e-\u0442\u043e"]|'
        );
    }

    public function testArray()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->log(array('item1', 'item2'));

        $this->assertEquals(
            $firephp->_getHeader(4),
            '93|[{"Type":"LOG","File":"...\/tests\/Features\/08-Primitives.php","Line":' . (__LINE__-4) .  '},["item1","item2"]]|'
        );
    }

    public function testAssociativeArray()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->log(array(
            'key1' => 'val1',
            'key2' => 'val2'
        ));

        $this->assertEquals(
            $firephp->_getHeader(4),
            '105|[{"Type":"LOG","File":"...\/tests\/Features\/08-Primitives.php","Line":' . (__LINE__-6) .  '},{"key1":"val1","key2":"val2"}]|'
        );
    }

    public function testObject()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->log(new ArrayObject());

        $this->assertEquals(
            $firephp->_getHeader(4),
            '105|[{"Type":"LOG","File":"...\/tests\/Features\/08-Primitives.php","Line":' . (__LINE__-4) .  '},{"__className":"ArrayObject"}]|'
        );
    }

    public function testInteger()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->log(1);

        $this->assertEquals(
            $firephp->_getHeader(4),
            '77|[{"Type":"LOG","File":"...\/tests\/Features\/08-Primitives.php","Line":' . (__LINE__-4) .  '},1]|'
        );
    }

    public function testBoolean()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->log(true);

        $this->assertEquals(
            $firephp->_getHeader(4),
            '80|[{"Type":"LOG","File":"...\/tests\/Features\/08-Primitives.php","Line":' . (__LINE__-4) .  '},true]|'
        );
    }    

    public function testNull()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->log(null);

        $this->assertEquals(
            $firephp->_getHeader(4),
            '80|[{"Type":"LOG","File":"...\/tests\/Features\/08-Primitives.php","Line":' . (__LINE__-4) .  '},null]|'
        );
    }
}
