<?php

class FirePHPCore_FirePHPTest extends PHPUnit_Framework_TestCase
{
    /**
     * @issue http://code.google.com/p/firephp/issues/detail?id=117
     */
    public function testDumpArguments()
    {
        $firephp = new FirePHP_Test_Class();

        $firephp->dump("key", "value");
        $headers = $firephp->getAllResponseHeaders();
        $this->assertEquals('X-Wf-1-2-1-1: 15|{"key":"value"}|', $headers['X-Wf-1-2-1-1']);

        $caught = false;
        try {
            $firephp->dump(array(), "value");
        } catch(Exception $e) {
            // Key passed to dump() is not a string
            $caught = true;
        }
        if(!$caught) $this->fail('No exception thrown');

        $caught = false;
        try {
            $firephp->dump("key \n\r value", "value");
        } catch(Exception $e) {
            // Key passed to dump() contains invalid characters [a-zA-Z0-9-_\.:]
            $caught = true;
        }
        if(!$caught) $this->fail('No exception thrown');

        $caught = false;
        try {
            $firephp->dump("keykeykeykkeykeykeykkeykeykeykkeykeykeykkeykeykeykkeykeykeykkeykeykeykkeykeykeykkeykeykeykkeykeykeyk1", "value");
        } catch(Exception $e) {
            // Key passed to dump() is longer than 100 characters
            $caught = true;
        }
        if(!$caught) $this->fail('No exception thrown');
    }
    
    /**
     * @issue http://code.google.com/p/firephp/issues/detail?id=123
     */
    public function testRegisterErrorHandler()
    {
        $firephp = new FirePHP_Test_Class();
        $firephp->setOption("maxObjectDepth", 1);
        $firephp->setOption("maxArrayDepth", 1);

        $firephp->registerErrorHandler();
        trigger_error("Hello World");
        $headers = $firephp->getAllResponseHeaders();
        if(!isset($headers["X-Wf-1-1-1-1"])) {
            $this->fail("Error not in headers");
        }
    }

    /**
     * @issue http://code.google.com/p/firephp/issues/detail?id=122
     */
    public function testFirePHPClassInstanceLogging()
    {
        $firephp = new FirePHP_Test_Class();

        $firephp->log($firephp);
        $headers = $firephp->getAllResponseHeaders();
        if(!preg_match_all('/"protected:objectStack":"\\*\\* Excluded by Filter \\*\\*"/', $headers['X-Wf-1-1-1-1'], $m)) {
            $this->fail("objectStack member contains value");
        }
        if(!preg_match_all('/"protected:static:instance":"\\*\\* Excluded by Filter \\*\\*"/', $headers['X-Wf-1-1-1-1'], $m)) {
            $this->fail("instance member should not be logged");
        }
        if(!preg_match_all('/"undeclared:json_objectStack":"\\*\\* Excluded by Filter \\*\\*"/', $headers['X-Wf-1-1-1-1'], $m)) {
            $this->fail("json_objectStack member should not be logged");
        }
    }
    
    /**
     * @issue http://code.google.com/p/firephp/issues/detail?id=114
     */
    public function testCustomFileLineOptions()
    {
        $firephp = new FirePHP_Test_Class();

        $firephp->log("message", "label", array("File"=>"/file/path", "Line"=>"1"));
        $firephp->info("message", "label", array("File"=>"/file/path", "Line"=>"1"));
        $firephp->warn("message", "label", array("File"=>"/file/path", "Line"=>"1"));
        $firephp->error("message", "label", array("File"=>"/file/path", "Line"=>"1"));
        $firephp->dump("key", "value", array("File"=>"/file/path", "Line"=>"1"));
        $firephp->table("label", array(array("header"),array("cell")), array("File"=>"/file/path", "Line"=>"1"));

        $headers = $firephp->getAllResponseHeaders();

        $this->assertEquals('X-Wf-1-1-1-1: 75|[{"File":"\/file\/path","Line":"1","Type":"LOG","Label":"label"},"message"]|', $headers['X-Wf-1-1-1-1']);
        $this->assertEquals('X-Wf-1-1-1-2: 76|[{"File":"\/file\/path","Line":"1","Type":"INFO","Label":"label"},"message"]|', $headers['X-Wf-1-1-1-2']);
        $this->assertEquals('X-Wf-1-1-1-3: 76|[{"File":"\/file\/path","Line":"1","Type":"WARN","Label":"label"},"message"]|', $headers['X-Wf-1-1-1-3']);
        $this->assertEquals('X-Wf-1-1-1-4: 77|[{"File":"\/file\/path","Line":"1","Type":"ERROR","Label":"label"},"message"]|', $headers['X-Wf-1-1-1-4']);
        $this->assertEquals('X-Wf-1-2-1-5: 15|{"key":"value"}|', $headers['X-Wf-1-2-1-5']);
        $this->assertEquals('X-Wf-1-1-1-6: 89|[{"File":"\/file\/path","Line":"1","Type":"TABLE","Label":"label"},[["header"],["cell"]]]|', $headers['X-Wf-1-1-1-6']);
    }
    
    public function testRecursiveEncode()
    {
        $firephp = new FirePHP_Test_Class();

        $obj = new FirePHPCore_FirePHPTest__TestObject();
        $obj->child = $obj;

        $firephp->log($obj, "label", array("File"=>"/file/path", "Line"=>"1"));
        $headers = $firephp->getAllResponseHeaders();
        $this->assertEquals('X-Wf-1-1-1-1: 215|[{"File":"\/file\/path","Line":"1","Type":"LOG","Label":"label"},{"__className":"FirePHPCore_FirePHPTest__TestObject","public:var":"value","undeclared:child":"** Recursion (FirePHPCore_FirePHPTest__TestObject) **"}]|', $headers['X-Wf-1-1-1-1']);
    }

    public function testOptions()
    {
        $firephp = new FirePHP_Test_Class();
        
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
    
    public function testDeprecatedMethods()
    {
        $firephp = new FirePHP_Test_Class();

        $caught = false;
        try {
            $firephp->setProcessorUrl('URL');
        } catch(Exception $e) {
            $caught = true;
            $this->assertEquals(E_USER_DEPRECATED, $e->getCode());
            $this->assertEquals('The FirePHP::setProcessorUrl() method is no longer supported', $e->getMessage());
        }
        if(!$caught) $this->fail('No deprecation error thrown');

        $caught = false;
        try {
            $firephp->setRendererUrl('URL');
        } catch(Exception $e) {
            $caught = true;
            $this->assertEquals(E_USER_DEPRECATED, $e->getCode());
            $this->assertEquals('The FirePHP::setRendererUrl() method is no longer supported', $e->getMessage());
        }
        if(!$caught) $this->fail('No deprecation error thrown');
    }
      
    public function testLimitHeaderSizeOneBigLog()
    {
        $firephp = new FirePHP_Test_Class();
        $firephp->setOption('maxCombinedSize', 20);

        // Log one 20k message
        $message = str_repeat('a', 20 * 1024);
        $firephp->log($message, "label", array("File"=>"/file/path", "Line"=>"1"));

        $this->assertEquals(array (
            'X-Wf-Protocol-1' => 'X-Wf-Protocol-1: http://meta.wildfirehq.org/Protocol/JsonStream/0.2',
            'X-Wf-1-Plugin-1' => 'X-Wf-1-Plugin-1: http://meta.firephp.org/Wildfire/Plugin/FirePHP/Library-FirePHPCore/0.3',
            'X-Wf-1-Structure-1' => 'X-Wf-1-Structure-1: http://meta.firephp.org/Wildfire/Structure/FirePHP/FirebugConsole/0.1',
            'X-Wf-Notify-Truncated' => 'X-Wf-Notify-Truncated: 20637',
          ), $firephp->getAllResponseHeaders(), 'One log message the size of the limit (20k) should be truncated');


        $firephp->log('small message', "label", array("File"=>"/file/path", "Line"=>"1"));
        $this->assertEquals(array(
            'X-Wf-Protocol-1' => 'X-Wf-Protocol-1: http://meta.wildfirehq.org/Protocol/JsonStream/0.2',
            'X-Wf-1-Plugin-1' => 'X-Wf-1-Plugin-1: http://meta.firephp.org/Wildfire/Plugin/FirePHP/Library-FirePHPCore/0.3',
            'X-Wf-1-Structure-1' => 'X-Wf-1-Structure-1: http://meta.firephp.org/Wildfire/Structure/FirePHP/FirebugConsole/0.1',
            'X-Wf-Notify-Truncated' => 'X-Wf-Notify-Truncated: 20736',
          ), $firephp->getAllResponseHeaders(), 'should not log small message after truncation');
    }

    public function testLimitHeaderSizeManySmallLog()
    {
        $firephp = new FirePHP_Test_Class();
        $firephp->setOption('maxCombinedSize', 20 * 1024);

        // Log 1k message 20 times
        $message = str_repeat('a', 1024);
        for ($i = 0; $i < 20; $i++)
        {
            $firephp->log($message, "label", array("File"=>"/file/path", "Line"=>"1"));
        }
        $headers = $firephp->getAllResponseHeaders();

        $this->assertEquals(20312, $firephp->getHeadersSentSize(), 'should not log more entries after truncated');
        $this->assertCount(23, $headers, 'should not log more entries after truncated');
        $this->assertEquals('X-Wf-Notify-Truncated: 2226', end($headers), 'last message should be the truncated warning');
    }

    public function testCanSetMaxCombinedSizeOptionViaHeader()
    {
        $firephp = new FirePHP_Test_Class();
        $this->assertEquals(0, $firephp->getOption('maxCombinedSize'), 'default to no limit');

        $_SERVER['HTTP_X-Wf-Max-Combined-Size'] = 250 * 1024;
        $firephp2 = new FirePHP_Test_Class();
        $this->assertEquals(250 * 1024, $firephp2->getOption('maxCombinedSize'), 'use limit specified in request header');
    }

    public function testExistingHeaders()
    {
        $firephp = new FirePHP_Test_Class();
        $firephp->setOption('maxCombinedSize', 400);

        $firephp->setResponseHeader('Content-Type', 'text/html; charset=UTF-8');
        $firephp->setResponseHeader('Content-Encoding', 'gzip');

        $firephp->log('foo');

        $this->assertEquals(array (
            'Content-Type' => 'Content-Type: text/html; charset=UTF-8',
            'Content-Encoding' => 'Content-Encoding: gzip',
            'X-Wf-Protocol-1' => 'X-Wf-Protocol-1: http://meta.wildfirehq.org/Protocol/JsonStream/0.2',
            'X-Wf-1-Plugin-1' => 'X-Wf-1-Plugin-1: http://meta.firephp.org/Wildfire/Plugin/FirePHP/Library-FirePHPCore/0.3',
            'X-Wf-1-Structure-1' => 'X-Wf-1-Structure-1: http://meta.firephp.org/Wildfire/Structure/FirePHP/FirebugConsole/0.1',
            'X-Wf-Notify-Truncated' => 'X-Wf-Notify-Truncated: 129',
         ), $firephp->getAllResponseHeaders(), 'should take into account non-FirePHP headers');
    }
}


class FirePHPCore_FirePHPTest__TestObject
{
    public $var = "value";
}
