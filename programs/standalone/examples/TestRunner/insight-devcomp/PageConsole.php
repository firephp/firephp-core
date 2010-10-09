<?php

$inspector = FirePHP::to("page"); 
 
$console = $inspector->console();




$console->log("Hello World"); 

$console->label('array')->log(array('Hello', 'World')); 
$console->label('array')->log(array('Hello' => 'World')); 
$console->label('array')->log(array('Hello' => 'World', 'Wide')); 

$console->label('boolean')->log(true); 

$console->label('float')->log(10.5); 

$console->label('integer')->log(1000);

$console->label('null')->log(null); 

$obj = new TestObject();
$obj->undeclared = 'undeclared';
$obj->children = array('sss', $obj);
$console->label('object')->log($obj);

$console->label('resource')->log(tmpfile());

$console->label('string')->log('Hello World'); 


class TestObject {
    public $public = 'public';
    public static $publicStatic = 'publicStatic';
    protected $protected = 'protected';
    protected static $protectedStatic = 'protectedStatic';
    private $private = 'private';
    private static $privateStatic = 'privateStatic';
}





$console->log('Plain message');
$console->info('Info message');
$console->warn('Warning message');
$console->error('Error message');




$header = array('Column 1 Heading', 'Column 2 Heading');
$table = array(
    array('Row 1 Column 1 Value', 'Row 1 Column 2 Value'),
    array(10, true)
);
$console->table('Table without header', $table);
$console->table('Table with header', $table, $header);




$console->trace('Trace to here');
