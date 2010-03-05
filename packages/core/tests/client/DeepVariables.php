<?php

$firephp = FirePHP::getInstance(true);

$firephp->setOptions(array('maxObjectDepth'=>2));

FB::setOptions(array('maxArrayDepth'=>3));


class TestObject {
  var $name = 'test data';
}

class TestObject2 {
  var $name1 = 'name 1';
  var $name2 = 'name 2';
  var $name3 = 'name 3';
}

$obj = new TestObject();
$obj->child = new TestObject();
$obj->child->child = new TestObject();
$obj->child->child->child = new TestObject();
$obj->child->child->child->child = new TestObject();

$obj->child2 = new TestObject2();
$obj->child2->name4 = 'name 4';

$firephp->setObjectFilter('TestObject2',array('name2','name4'));

$firephp->fb($obj);

$array = array();
$array['name'] = 'test data';
$array['child']['name'] = 'test data';
$array['child']['obj'] = $obj;
$array['child']['child']['name'] = 'test data';
$array['child']['child']['child']['name'] = 'test data';
$obj->childArray = $array;

FB::setObjectFilter('TestObject2',array('name2','name3'));

$firephp->fb($array);


$table = array();
$table[] = array('Col1','Col2');
$table[] = array($obj, $array);
$table[] = array($obj, $array);
$table[] = array($obj, $array);

try {
  test($table);
} catch(Exception $e) {
  $firephp->error($e);
}

function test($table) {
  FB::table('Test deep table',$table);

  FB::send(array('Test deep table',$table), FirePHP::TABLE);
  
  throw new Exception('Test Exception');
}