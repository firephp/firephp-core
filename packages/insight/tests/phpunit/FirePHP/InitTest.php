<?php

require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'TestHelper.php';
 

class FirePHP_InitTest extends PHPUnit_Framework_TestCase
{
    public function testConnect()
    {
        $console = FirePHP::to('process')->console();

        $console->label('Label 1')->log('Hello World 1');
        $console->expand()->label('Label 2')->log('Hello World 2');

        $console->show();
    }
}
