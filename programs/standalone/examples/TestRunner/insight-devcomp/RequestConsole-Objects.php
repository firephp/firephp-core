<?php

$inspector = FirePHP::to("request"); 
 
$console = $inspector->console('Objects');


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
  public $publicVar5 = 'var5';
  public $privateVar2;
  public $privateVar3 = false;
  public $privateVar4 = 'var4';
  
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


$console->log($obj);


$obj1 = new stdClass;
$obj2 = new stdClass;
$obj1->p = $obj2;
$obj2->p = $obj1;

$console->log($obj1);


$console->filter(array('classes'=>array(
    'TestObject' => array('publicVar', 'protectedVar', 'privateStaticVar', 'publicStaticVar2'),
    'TestObject2' => array('privateVar')
)))->log($obj);



$obj1 = new stdClass;
$obj1->x0 = array( 0 => 1);
$obj1->y0 = array( 0 => 2);
$obj1->x1 = array( 1 => 1);
$obj1->y1 = array( 1 => 2);
$console->log($obj1);
