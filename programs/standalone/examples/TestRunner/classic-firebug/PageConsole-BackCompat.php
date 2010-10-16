<?php

$firephp = FirePHP::getInstance(true);


$firephp->log("Hello World");
$firephp->info("Hello World");
$firephp->warn("Hello World");
$firephp->error("Hello World");

$firephp->fb("Hello World", "string");

$firephp->fb(array('Hello', 'World'), 'array'); 

$firephp->fb(array('Hello' => 'World'), 'array'); 

$firephp->fb(array('Hello' => 'World', 'Wide'), 'array'); 

$firephp->fb(true, 'boolean'); 

$firephp->fb(false, 'boolean'); 

$firephp->fb(null, 'null'); 

$firephp->fb(10.5, 'float'); 

$firephp->fb(1000, 'integer'); 

$firephp->fb(tmpfile(), 'resource'); 

$firephp->dump('Key', 'Value');


$firephp->trace('Trace to here');


try {
    throw new Exception("Test Exception");
} catch(Exception $e) {
    $firephp->error($e);
}


$table = array(
    array('Column 1 Heading', 'Column 2 Heading'),
    array('Row 1 Column 1 Value', 'Row 1 Column 2 Value'),
    array(10, true)
);
$firephp->table('Table with header', $table);


$obj = new TestObject();
$obj->undeclared = 'undeclared';
$obj->children = array('sss', $obj);
$firephp->fb($obj, 'object');
class TestObject {
    public $public = 'public';
    public static $publicStatic = 'publicStatic';
    protected $protected = 'protected';
    protected static $protectedStatic = 'protectedStatic';
    private $private = 'private';
    private static $privateStatic = 'privateStatic';
}


$firephp->setObjectFilter('TestClass', array('var1'));
$obj = new TestClass();
$firephp->fb($obj, 'filtered object');
class TestClass {
    public $var1 = 'Variable 1';
    public $var2 = 'Variable 2';
}


$firephp->group('Test Group 1');
$firephp->log('Hello World 1');
    $firephp->group('Test Group 2');
    $firephp->log('Hello World 2');
    $firephp->groupEnd();
$firephp->groupEnd();

