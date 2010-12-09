<?php

$console = FirePHP::to("page")->console();

$str = array();
for( $i=0 ; $i<10 ; $i++ ) {
    $str[] = 'This is a long string that will be truncated.';
}

$console->option('encoder.maxStringLength', 250)->label('Truncated')->log(implode("\n", $str));
