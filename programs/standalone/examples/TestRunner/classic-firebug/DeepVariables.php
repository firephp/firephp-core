<?php

$firephp = FirePHP::getInstance(true);

$firephp->setOptions(array('maxObjectDepth' => 2));

FB::setOptions(array('maxDepth' => 8, 'maxArrayDepth' => 3));


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


$deep = array();
$obj1 = new TestObject();
$deep['key'] = $obj1;
$obj1->child = array();
$obj2 = new TestObject();
$obj1->child['key'] = $obj2;
$obj2->child = array();
$obj3 = new TestObject();
$obj2->child['key'] = $obj3;
$obj3->child = array();
$obj4 = new TestObject();
$obj3->child['key'] = $obj4;
$obj4->child = array();
$obj5 = new TestObject();
$obj4->child['key'] = $obj5;
$obj5->child = array();
$obj5->child['key'] = 'Value';

$firephp->fb($deep);


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