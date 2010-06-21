<?php

$inspector = FirePHP::to("request"); 
 
$console = $inspector->console('Post Test');

$console->label('Time')->log(time());

$console->label('Post Data')->log($_POST);
