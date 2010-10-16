<?php

$inspector = FirePHP::to("page"); 
 
$console = $inspector->console();


$obj1 = new TestObject();
$obj1->undeclared = 'undeclared';
$obj1->children = array('sss', $obj1);
class TestObject {
    public $public = 'public';
    public static $publicStatic = 'publicStatic';
    protected $protected = 'protected';
    protected static $protectedStatic = 'protectedStatic';
    private $private = 'private';
    private static $privateStatic = 'privateStatic';
}



$filter = array(
    'classes' => array(
        'TestClass' => array('var1')
    )
);
$console = $console->filter($filter);
$obj2 = new TestClass();
class TestClass {
    public $var1 = 'Variable 1';
    public $var2 = 'Variable 2';
}



$header = array('Column 1 Heading', 'Column 2 Heading');
$table = array(
    array('Row 1 Column 1 Value', 'Row 1 Column 2 Value'),
    array(10, true),
    array($obj1, $obj2)
);
$console->table('Table with header', $table, $header);
