<?php

$firephp = FirePHP::getInstance(true);

$obj = new TestObject();
$obj1 = new TestObject1();
$obj1->child = new TestObject2();
$obj1->depper = array('2' => new TestObject3());
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

$firephp->fb($obj, 'object 1');


$firephp->setOption('maxArrayDepth', 2);
$firephp->setOption('maxObjectDepth', 2);
$firephp->setOption('maxDepth', 4);

$firephp->fb($obj, 'object 2');
