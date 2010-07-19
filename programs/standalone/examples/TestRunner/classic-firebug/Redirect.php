<?php

$firephp = FirePHP::getInstance(true);

$firephp->log('Redirect Request');

$url = str_replace('file=Redirect.php', 'file=RedirectTarget.php', $_SERVER['REQUEST_URI']);

header('Location: ' . $url);
