<?php

// Bootstrap File

/* NOTE: You must have the FirePHP library on your include path */
$libPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME']))) . DIRECTORY_SEPARATOR . "lib";

$includePath = explode(PATH_SEPARATOR, get_include_path());
if(!in_array($libPath, $includePath)) {
    array_unshift($includePath, $libPath);
    set_include_path(implode(PATH_SEPARATOR, $includePath));
}

define('INSIGHT_IPS', '*');
define('INSIGHT_AUTHKEYS', '*');
define('INSIGHT_PATHS', __DIR__);
define('INSIGHT_SERVER_PATH', './index.php');

require_once('FirePHP/Init.php');

FirePHP::plugin('firephp')->trapProblems();
FirePHP::plugin('firephp')->recordEnvironment(
    FirePHP::to('request')->console('Environment')->on('Show Environment')
);

FirePHP::to('request')->console('Feed')->info('Startup');

// Application Code

require_once(__DIR__ . '/feed.php');

$feed = new Feed('http://www.phpdeveloper.org/feed');

foreach( $feed->getItems() as $item ) {
    echo '<p><a href="'.$item['link'].'">'.$item['title'].'</a></p>'."\n";
}

FirePHP::to('request')->console('Feed')->info('Shutdown');
