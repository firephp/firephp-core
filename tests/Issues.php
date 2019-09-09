<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class Issues extends TestCase
{
    /**
     * @issue http://code.google.com/p/firephp/issues/detail?id=117
     */
    public function testDumpArguments()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->dump("key", "value");
        $headers = $firephp->_getHeaders();
        $this->assertEquals('15|{"key":"value"}|', $headers['X-Wf-1-2-1-1']);
        $firephp->_clearHeaders();

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
        $firephp = new FirePHP_TestWrapper();
        $firephp->setOption("maxObjectDepth", 1);
        $firephp->setOption("maxArrayDepth", 1);

        $firephp->registerErrorHandler();
        trigger_error("Hello World");
        $headers = $firephp->_getHeaders();
        if(!isset($headers["X-Wf-1-1-1-1"])) {
            $this->fail("Error not in headers");
        }
    }

    /**
     * @issue http://code.google.com/p/firephp/issues/detail?id=122
     */
    public function testFirePHPClassInstanceLogging()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->log($firephp);
        $headers = $firephp->_getHeaders();

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
        $firephp = new FirePHP_TestWrapper();

        $firephp->log("message", "label", array("File"=>"/file/path", "Line"=>"1"));
        $firephp->info("message", "label", array("File"=>"/file/path", "Line"=>"1"));
        $firephp->warn("message", "label", array("File"=>"/file/path", "Line"=>"1"));
        $firephp->error("message", "label", array("File"=>"/file/path", "Line"=>"1"));
        $firephp->dump("key", "value", array("File"=>"/file/path", "Line"=>"1"));
        $firephp->table("label", array(array("header"),array("cell")), array("File"=>"/file/path", "Line"=>"1"));

        $headers = $firephp->_getHeaders();

        $this->assertEquals('75|[{"File":"\/file\/path","Line":"1","Type":"LOG","Label":"label"},"message"]|', $headers['X-Wf-1-1-1-1']);
        $this->assertEquals('76|[{"File":"\/file\/path","Line":"1","Type":"INFO","Label":"label"},"message"]|', $headers['X-Wf-1-1-1-2']);
        $this->assertEquals('76|[{"File":"\/file\/path","Line":"1","Type":"WARN","Label":"label"},"message"]|', $headers['X-Wf-1-1-1-3']);
        $this->assertEquals('77|[{"File":"\/file\/path","Line":"1","Type":"ERROR","Label":"label"},"message"]|', $headers['X-Wf-1-1-1-4']);
        $this->assertEquals('15|{"key":"value"}|', $headers['X-Wf-1-2-1-5']);
        $this->assertEquals('89|[{"File":"\/file\/path","Line":"1","Type":"TABLE","Label":"label"},[["header"],["cell"]]]|', $headers['X-Wf-1-1-1-6']);
    }

    /**
     * @issue https://github.com/firephp/firephp-core/issues/18
     */
    public function testGroupZeroLabel()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->group(0);
        $firephp->group("0");
        $firephp->group(false);

        $this->assertEquals(
            $firephp->_getHeader(4),
            '82|[{"Type":"GROUP_START","Label":0,"File":"...\/tests\/Issues.php","Line":' . (__LINE__-6) . '},null]|'
        );
        $this->assertEquals(
            $firephp->_getHeader(6),
            '84|[{"Type":"GROUP_START","Label":"0","File":"...\/tests\/Issues.php","Line":' . (__LINE__-9) . '},null]|'
        );
        $this->assertEquals(
            $firephp->_getHeader(7),
            '86|[{"Type":"GROUP_START","Label":false,"File":"...\/tests\/Issues.php","Line":' . (__LINE__-12) . '},null]|'
        );

        try {
            $firephp->group(null);
            $this->fail('This should never be reached!');
        } catch (Exception $e) {
            $this->assertEquals(
                $e->getMessage(),
                'You must specify a label for the group!'
            );
        }
    }

    /**
     * @issue https://github.com/firephp/firephp-core/issues/5
     */
    public function testIncorrectArrayDisplay()
    {
        $firephp = new FirePHP_TestWrapper();

        $firephp->log(array(
            '1' => array(1)
        )); 

        $this->assertEquals(
            $firephp->_getHeader(4),
            '69|[{"Type":"LOG","File":"...\/tests\/Issues.php","Line":' . (__LINE__-5) . '},{"1":[1]}]|'
        );
    }
}
