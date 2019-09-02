<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class Features_RecursiveEncoding extends TestCase
{
    public function testRecursiveEncode()
    {
        $firephp = new FirePHP_TestWrapper();

        $obj = new TestObject();
        $obj->child = $obj;

        $firephp->log($obj, "label", array("File"=>"/file/path", "Line"=>"1"));
        $headers = $firephp->_getHeaders();
        $this->assertEquals('165|[{"File":"\/file\/path","Line":"1","Type":"LOG","Label":"label"},{"__className":"TestObject","public:var":"value","undeclared:child":"** Recursion (TestObject) **"}]|', $headers['X-Wf-1-1-1-1']);
    }
}

class TestObject
{
    public $var = "value";
}