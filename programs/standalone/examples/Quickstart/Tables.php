<?php

// See Firebug Console for result

require_once('_init_.php');

$inspector = FirePHP::to('page');
$console = $inspector->console();

$table = array();
$table[] = array('Row 1  Column 1', 'Row 1 Column 2');
$table[] = array('Row 2  Column 1', 'Row 2 Column 2');
$console->table('Sample Table', $table, array('Column 1', 'Column 2'));

$obj = new stdClass();
$obj->key1 = 'Value 1';
$obj->key2 = 'Value 2';
$console->table('Object', $obj, array('Name', 'Value'));

$console->table('INI Options', getOptions(), array('Extension', 'Name', 'Global', 'Local'));

function getOptions() {
    $options = array();
    foreach( ini_get_all() as $name => $info ) {
        $parts = explode(".", $name);
        $options[] = array(
            (count($parts)==1)?"":$parts[0],
            (count($parts)==1)?$parts[0]:$parts[1],
            $info['global_value'],
            $info['local_value']
        );
    }
    return $options;
}

highlight_file(__FILE__);