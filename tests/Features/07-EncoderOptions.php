<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class Features_EncoderOptions extends TestCase
{
    protected function _makeObjectChain () {
        $o1 = new Test1();
        $o2 = new Test2();
        $o3 = new Test3();
        $o4 = new Test4();
        $o5 = new Test5();
        $o6 = new Test6();

        $o1->sub1 = array(
            'key1' => $o2
        );
        $o2->sub2 = array(
            'key2' => array(
                'key3' => array(
                    'key4' => $o3
                )
            )
        );
        $o3->sub3 = $o4;
        $o4->sub4 = $o5;
        $o5->sub5 = array(
            'key5' => 'val1'
        );
        return $o1;
    }

    public function testDefaults()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->log($this->_makeObjectChain());

        $this->assertEquals(
            $firephp->_getHeader(4),
            '357|[{"Type":"LOG","File":"...\/tests\/Features\/07-EncoderOptions.php","Line":' . (__LINE__-4) .  '},{"__className":"Test1","undeclared:sub1":{"key1":{"__className":"Test2","undeclared:sub2":{"key2":{"key3":{"key4":{"__className":"Test3","undeclared:sub3":{"__className":"Test4","undeclared:sub4":{"__className":"Test5","undeclared:sub5":{"key5":"** Max Depth (11) **"}}}}}}}}}}]|'
        );
    }

    public function testMaxArrayDepth()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->setOption('maxArrayDepth', 2);

        $firephp->log($this->_makeObjectChain());

        $this->assertEquals(
            $firephp->_getHeader(4),
            '218|[{"Type":"LOG","File":"...\/tests\/Features\/07-EncoderOptions.php","Line":' . (__LINE__-4) .  '},{"__className":"Test1","undeclared:sub1":{"key1":{"__className":"Test2","undeclared:sub2":{"key2":{"key3":"** Max Array Depth (2) **"}}}}}]|'
        );
    }

    public function testMaxObjectDepth()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->setOption('maxObjectDepth', 2);

        $firephp->log($this->_makeObjectChain());

        $this->assertEquals(
            $firephp->_getHeader(4),
            '312|[{"Type":"LOG","File":"...\/tests\/Features\/07-EncoderOptions.php","Line":' . (__LINE__-4) .  '},{"__className":"Test1","undeclared:sub1":{"key1":{"__className":"Test2","undeclared:sub2":{"key2":{"key3":{"key4":{"__className":"Test3","undeclared:sub3":{"__className":"Test4","undeclared:sub4":"** Max Object Depth (2) **"}}}}}}}}]|'
        );
    }

    public function testMaxDepth()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->setOption('maxDepth', 2);

        $firephp->log($this->_makeObjectChain());

        $this->assertEquals(
            $firephp->_getHeader(4),
            '152|[{"Type":"LOG","File":"...\/tests\/Features\/07-EncoderOptions.php","Line":' . (__LINE__-4) .  '},{"__className":"Test1","undeclared:sub1":{"key1":"** Max Depth (3) **"}}]|'
        );
    }

    public function testSetObjectFilter()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->setObjectFilter('Test3', array('sub3'));

        $firephp->log($this->_makeObjectChain());

        $this->assertEquals(
            $firephp->_getHeader(4),
            '268|[{"Type":"LOG","File":"...\/tests\/Features\/07-EncoderOptions.php","Line":' . (__LINE__-4) .  '},{"__className":"Test1","undeclared:sub1":{"key1":{"__className":"Test2","undeclared:sub2":{"key2":{"key3":{"key4":{"__className":"Test3","undeclared:sub3":"** Excluded by Filter **"}}}}}}}]|'
        );

        $firephp->setObjectFilter('Test3', true);

        $firephp->log($this->_makeObjectChain());

        $this->assertEquals(
            $firephp->_getHeader(6),
            '235|[{"Type":"LOG","File":"...\/tests\/Features\/07-EncoderOptions.php","Line":' . (__LINE__-4) . '},{"__className":"Test1","undeclared:sub1":{"key1":{"__className":"Test2","undeclared:sub2":{"key2":{"key3":{"key4":"** Excluded by Filter (Test3) **"}}}}}}]|'
        );
    }
}

class Test1 {
}
class Test2 {
}
class Test3 {
}
class Test4 {
}
class Test5 {
}
class Test6 {
}
class Test7 {
}
class Test8 {
}
