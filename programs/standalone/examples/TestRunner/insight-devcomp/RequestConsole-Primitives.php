<?php

$inspector = FirePHP::to("request"); 
 
$console = $inspector->console('Primitives');

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

