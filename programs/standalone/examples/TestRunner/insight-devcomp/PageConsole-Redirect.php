<?php

$console = FirePHP::to("page")->console();

$console->log('Redirect Request');

$url = str_replace('file=PageConsole-Redirect.php', 'file=PageConsole-RedirectTarget.php', $_SERVER['REQUEST_URI']);

header('Location: ' . $url);
