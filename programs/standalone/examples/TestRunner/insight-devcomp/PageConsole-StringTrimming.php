<?php

$console = FirePHP::to("page")->console();

$header = array('Heading');
$table = array(
    array('This is a long string that should not be trimmed when displaying in firebug console'),
    array("This is a message with\nmultiple lines\nthat should show on\nmultiple lines"),
    array("Another message with\nmultiple lines\nthat has a newline at the end\n")
);
$console->table('Trimmed Table', $table, $header);
$console->notrim()->table('Untrimmed Table', $table, $header);
$console->option('string.trim.length', 70)->table('Partial Trimmed Table', $table, $header);
$console->options(array(
    'string.trim.length' => 70,
    'string.trim.newlines' => false
))->table('Partial Trimmed Table', $table, $header);


$console->label('Untrimmed')->log('This is a long string that should not be trimmed when displaying in firebug console. This is a long string that should not be trimmed when displaying in firebug console.');
$console->label('Untrimmed')->info('This is a long string that should not be trimmed when displaying in firebug console. This is a long string that should not be trimmed when displaying in firebug console.');
$console->label('Untrimmed')->warn('This is a long string that should not be trimmed when displaying in firebug console. This is a long string that should not be trimmed when displaying in firebug console.');

$console->option('string.trim.enabled', true)->label('Trimmed')->log('This is a long string that should be trimmed when displaying in firebug console');

$console->label('Trimmed')->log(
    'This is a long string that should be trimmed when displaying in firebug console. ' . 
    'This is a long string that should be trimmed when displaying in firebug console. ' . 
    'This is a long string that should be trimmed when displaying in firebug console. ' . 
    'This is a long string that should be trimmed when displaying in firebug console. ' . 
    'This is a long string that should be trimmed when displaying in firebug console. ' . 
    'This is a long string that should be trimmed when displaying in firebug console. ' . 
    'This is a long string that should be trimmed when displaying in firebug console. ' . 
    'This is a long string that should be trimmed when displaying in firebug console. ' . 
    'This is a long string that should be trimmed when displaying in firebug console. ' . 
    'This is a long string that should be trimmed when displaying in firebug console. '
);

$console->notrim()->label('Untrimmed')->log(
    'This is a long string that should be trimmed when displaying in firebug console. ' . 
    'This is a long string that should be trimmed when displaying in firebug console. ' . 
    'This is a long string that should be trimmed when displaying in firebug console. ' . 
    'This is a long string that should be trimmed when displaying in firebug console. ' . 
    'This is a long string that should be trimmed when displaying in firebug console. ' . 
    'This is a long string that should be trimmed when displaying in firebug console. ' . 
    'This is a long string that should be trimmed when displaying in firebug console. ' . 
    'This is a long string that should be trimmed when displaying in firebug console. ' . 
    'This is a long string that should be trimmed when displaying in firebug console. ' . 
    'This is a long string that should be trimmed when displaying in firebug console. '
);
