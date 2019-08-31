<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class Features_RecursiveEncoding extends TestCase
{
    public function testRecursiveEncode()
    {
        $firephp = new FirePHP_TestWrapper();

        $obj = new FirePHPCore_FirePHPTest__TestObject();
        $obj->child = $obj;

        $firephp->log($obj, "label", array("File"=>"/file/path", "Line"=>"1"));
        $headers = $firephp->_getHeaders();
        $this->assertEquals('215|[{"File":"\/file\/path","Line":"1","Type":"LOG","Label":"label"},{"__className":"FirePHPCore_FirePHPTest__TestObject","public:var":"value","undeclared:child":"** Recursion (FirePHPCore_FirePHPTest__TestObject) **"}]|', $headers['X-Wf-1-1-1-1']);
    }
}
