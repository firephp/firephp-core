<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class Features_Options extends TestCase
{
    public function testOptions()
    {
        $firephp = new FirePHP_TestWrapper();
        
        // defaults
        $this->assertEquals(5, $firephp->getOption("maxObjectDepth"));
        $this->assertEquals(5, $firephp->getOption("maxArrayDepth"));
        $this->assertEquals(true, $firephp->getOption("useNativeJsonEncode"));
        $this->assertEquals(true, $firephp->getOption("includeLineNumbers"));
        
        // modify
        $firephp->setOption("maxObjectDepth", 1);
        $this->assertEquals(1, $firephp->getOption("maxObjectDepth"));
        
        // invalid
        $caught = false;
        try {
            $firephp->setOption("invalidName", 1);
        } catch(Exception $e) {
            $caught = true;
        }
        if(!$caught) $this->fail('No exception thrown');

        $caught = false;
        try {
            $firephp->getOption("invalidName");
        } catch(Exception $e) {
            $caught = true;
        }
        if(!$caught) $this->fail('No exception thrown');
    }

    public function testSetFileLine()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->log('Hello World', 'Label', array("File"=>"/file/path", "Line"=>"1"));

        $this->assertEquals(
            $firephp->_getHeader(4),
            '79|[{"File":"\/file\/path","Line":"1","Type":"LOG","Label":"Label"},"Hello World"]|'
        );
    }

    public function testDoNotIncludeFileLine()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->log('Hello World');

        $this->assertEquals(
            $firephp->_getHeader(4),
            '86|[{"Type":"LOG","File":"...\/tests\/Features\/04-Options.php","Line":' . (__LINE__-4) . '},"Hello World"]|'
        );

        $firephp->setOption('includeLineNumbers', false);

        $firephp->log('Hello World');

        $this->assertEquals(
            $firephp->_getHeader(6),
            '30|[{"Type":"LOG"},"Hello World"]|'
        );
    }

    public function testNativeEncode()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->setOption('useNativeJsonEncode', false);

        $firephp->log('Hello World');

        $this->assertEquals(
            $firephp->_getHeader(4),
            '86|[{"Type":"LOG","File":"...\/tests\/Features\/04-Options.php","Line":' . (__LINE__-4) . '},"Hello World"]|'
        );

        $firephp->setOption('useNativeJsonEncode', true);

        $firephp->log('Hello World');

        $this->assertEquals(
            $firephp->_getHeader(6),
            '86|[{"Type":"LOG","File":"...\/tests\/Features\/04-Options.php","Line":' . (__LINE__-4) . '},"Hello World"]|'
        );
    }
}
