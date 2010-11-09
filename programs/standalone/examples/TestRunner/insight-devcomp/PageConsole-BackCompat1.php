<?php

$inspector = FirePHP::to("page"); 
 
$console = $inspector->console();

$console->log("Hello World");
$console->info("Hello World"); 
$console->warn("Hello World"); 
$console->error("Hello World"); 

$console->label("string")->log("Hello World"); 

$console->label('array')->log(array('Hello', 'World')); 

$console->label('array')->log(array('Hello' => 'World')); 

$console->label('array')->log(array('Hello' => 'World', 'Wide')); 

$console->label('boolean')->log(true); 

$console->label('boolean')->log(false); 

$console->label('null')->log(null); 

$console->label('float')->log(10.5); 

$console->label('integer')->log(1000);

$console->label('resource')->log(tmpfile());

$console->dump('Key', 'Value');


$console->trace('Trace to here');


try {
    throw new Exception("Test Exception");
} catch(Exception $e) {
    $console->error($e);
}


$header = array('Column 1 Heading', 'Column 2 Heading');
$table = array(
    array('Row 1 Column 1 Value', 'Row 1 Column 2 Value'),
    array(10, true)
);
$console->table('Table with header', $table, $header);


$obj = new TestObject();
$obj->undeclared = 'undeclared';
$obj->children = array('sss', $obj);
$console->label('object')->log($obj);
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
$obj = new TestClass();
$console->label('filtered object')->log($obj);
class TestClass {
    public $var1 = 'Variable 1';
    public $var2 = 'Variable 2';
}


$group = $console->group()->open();
$console->log('Test Group 1');
$console->log('Hello World 1');
    $group1 = $console->group()->open();
    $console->log('Test Group 2');
    $console->log('Hello World 2');
    $group1->close();
$group->close();


for($i=0;$i<3;$i++){
    $console->label($i)->log('hello');
}
