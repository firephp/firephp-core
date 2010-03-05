<?php

$firephp = FirePHP::getInstance(true);

header('X-FirePHP-ProcessorURL: http://org.firephp.firephpcore.birth.macbook.home.cadorn.net:10088/tests/client/CustomRequestProcessor.js');

$firephp->table('Custom Processor Template',
    array(
        array("col1", "col2"),
        array("row1", "row1"),
        array("row2", "row2")
    )
);
