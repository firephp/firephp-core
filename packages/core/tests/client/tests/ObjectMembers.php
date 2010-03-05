<?php

class TestObject
{
  var $publicVar = 'Public Var';
  static $publicStaticVar = 'Public static Var';
  protected $protectedVar = 'Protected Var';
  protected static $protectedStaticVar = 'Protected static Var';
  private $privateVar = 'PrivateVar';
  private static $privateStaticVar = 'Private static Var';
  public $publicVar2 = 'Public var 2';
  public static $publicStaticVar2 = 'Public static var 2';

  public $publicVar3;
  public $publicVar4 = false;
  public $publicVar5 = '';
  public $privateVar2;
  public $privateVar3 = false;
  public $privateVar4 = '';
  
  private $lotsOfData = "jhsdfjkhsdfjh sdkjhfasjkdhf sakjdhfg skaj dfhsa dfk jhsdfgkjsa dfksadf sadf sadfh\n jksdjhfg sadjkhfsahjdfghja sdfkj sajdfhkgsadfhj sfd jahksdfhjas dfjkahsdfhjasg dfkas df jhasdf ajkshdfgjhkadfs";
}

class TestObject2
{
  var $publicVar = 'Public Var';
  private $privateVar = 'PrivateVar';
}

class TestObject3
{
}


$obj = new TestObject();

$obj2 = new TestObject2();

$obj3 = new TestObject3();

$obj->child = $obj2;
$obj->child2 = $obj3;
$obj->child3 = $obj;

$obj = array('hello'=>'world','obj'=>$obj,'last'=>30,array('foo'=>'bar'),array('first','second'));


FB::log($obj, 'The object and all its members');


$obj1 = new stdClass;
$obj2 = new stdClass;
$obj1->p = $obj2;
$obj2->p = $obj1;

FB::log($obj1,'$obj1');


FB::setObjectFilter('TestObject', array('publicVar', 'protectedVar', 'privateStaticVar', 'publicStaticVar2'));
FB::setObjectFilter('TestObject2', array('privateVar'));

FB::log($obj, 'The object and all its members');
