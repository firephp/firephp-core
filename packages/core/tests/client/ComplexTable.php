<?php

$firephp = FirePHP::getInstance(true);


$table = array();

$table[] = array('Column 1', 'Column 2', 'Column 3');

$table[] = array('Row 1 Col 1', 'Row 1 Col 2', 'Row 1 Col3');
$table[] = array('Row 2 Col 1', 'Row 2 Col 2', 'Row 2 Col3');

$row = array();
$row[] = '<p>Value for column 1</p>';
$row[] = 'This is a very long value for column 2.'."\n\n".' kjhsdgf ksd sadkfhgsadhfs adfjhksagdfkhjsadgf sakjhdfgasdhkfgsjhakdf jkhsadfggksadfg iweafiuwaehfiulawhef liawefiluhawefiuhwaeiufl iulhaweiuflhwailuefh iluwahefiluawhefuiawefh lwaieufhwaiulefhawef liawuefhawiluefhawfl';
$row[] = '<p>First paragraph</p>'."\n".'<p>Second paragraph</p>';
$table[] = $row;


$row = array();
$row[] = 'Object and Array';
$row[] = new TestObject();
$row[] = array('key1'=>'val1','key2'=>'val2');
$table[] = $row;


$firephp->fb(array('This is the table label',$table),
             FirePHP::TABLE);
$firephp->fb($table, 'This is the table label',
             FirePHP::TABLE);
$firephp->table('This is the table label', $table);




class TestObject {
  
  var $member1 = 'string';
  var $member2 = true;
  var $member3 = false;
  var $member4 = null;
  var $member5 = 1;
  var $member6 = 1.1;
  var $member7 = array();
  var $member8 = array('string');

}