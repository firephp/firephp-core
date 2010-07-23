<?php

$inspector = FirePHP::to("request"); 
 
$console = $inspector->console('Info');

$console->log('Redirect Request');

$url = str_replace('file=RequestConsole-Redirect.php', 'file=RequestConsole-RedirectTarget.php', $_SERVER['REQUEST_URI']);

header('Location: ' . $url);
