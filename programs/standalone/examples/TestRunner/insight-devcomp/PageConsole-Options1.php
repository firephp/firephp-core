<?php

$inspector = FirePHP::to("page"); 
 
$console = $inspector->console();

$console->label('Option: encoder.maxArrayDepth')->log($console->option('encoder.maxArrayDepth'));

$obj = new TestObject();
$obj1 = new TestObject1();
$obj1->child = new TestObject2();
$obj3 = new TestObject3();
$obj3->deeper = array('go' => 'depper');
$obj1->depper = array('2' => $obj3);
$obj->undeclared = 'undeclared';
$obj->child = $obj1;
$obj->deepArray = array('A', array('very' => array('deep', array('array'))));
$obj->anotherChild = true;
$obj->mixedArray = array('1', $obj1);
class TestObject {
    public $public = 'public';
}
class TestObject1 {}
class TestObject2 {}
class TestObject3 {}

$console = $console->option('encoder.maxDepth', 7);

$console->label('object 1')->log($obj);



$console1 = $console->options(array(
    'encoder.maxArrayDepth' => 2,
    'encoder.maxObjectDepth' => 2,
    'encoder.maxDepth' => 3
));
$table = array();
$arr = array(array('ss'=>array('fgdfg'=>array('dsfdf'=>'dfgdfg'))));
$table[] = array($obj, $arr);
$console1->table('Trimmed Table', $table, array('Column 1', 'Column 2'));


$console = $console->option('encoder.maxArrayDepth', 2);
$console = $console->options(array(
    'encoder.maxObjectDepth' => 2,
    'encoder.maxDepth' => 5
));

$console->label('object 2')->log($obj);

$console->nolimit()->label('object 3')->log($obj);

$console->label('Option: encoder.maxArrayDepth')->log($console->option('encoder.maxArrayDepth'));


$console = $console->options(array(
    'encoder.maxArrayDepth' => -1,
    'encoder.maxObjectDepth' => -1,
    'encoder.maxDepth' => -1
));
$console->label('object 4')->log($obj);

$console->label('Options')->log($console->options());


function trace1($console) {
    trace2($console);
}
function trace2($console) {
    $console->trace('Trace to here');
    try {
        throw new Exception('Test Exception');
    } catch(Exception $e) {
        $console->error($e);
    }
}
$console = $console->options(array(
    'encoder.trace.maxLength' => 2,
    'encoder.exception.traceMaxLength' => 1
));
trace2($console);



$vars =  array();
$obj = new TestObject1();
for( $i=0 ; $i < 10 ; $i++ ) {
    $vars['Key ' . $i] = 'Value ' . $i;
    $varName = 'var' . $i;
    $obj->$varName = 'Value ' . $i;
}
$console = $console->option('encoder.maxArrayLength', 5);
$console->log($vars);

$console = $console->option('encoder.maxObjectLength', 5);
$console->log($obj);

$console = $console->options(array(
    'encoder.maxArrayLength' => -1,
    'encoder.maxObjectLength' => -1
));
$console->log($vars);
$console->log($obj);

