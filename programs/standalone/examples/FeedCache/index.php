<?php

/*i*/ // Denotes instructions used for insight that may be stripped out

// Bootstrap File

/* NOTE: You must have the FirePHP library on your include path */
/*i*/ $libPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME']))) . DIRECTORY_SEPARATOR . "lib";
/*i*/ $includePath = explode(PATH_SEPARATOR, get_include_path());
/*i*/ if(!in_array($libPath, $includePath)) {
/*i*/     array_unshift($includePath, $libPath);
/*i*/     set_include_path(implode(PATH_SEPARATOR, $includePath));
/*i*/ }

/*i*/ define('INSIGHT_IPS', '*');
/*i*/ define('INSIGHT_AUTHKEYS', '*');
/*i*/ define('INSIGHT_PATHS', __DIR__);
/*i*/ define('INSIGHT_SERVER_PATH', './index.php');

/*i*/ require_once('FirePHP/Init.php');

/*i*/ FirePHP::plugin('firephp')->trapProblems();
/*i*/ FirePHP::plugin('firephp')->recordEnvironment(
/*i*/     FirePHP::to('request')->console('Environment')->on('Show Environment')
/*i*/ );

/*i*/ FirePHP::to('request')->console('Feed')->info('Startup');

// Application Code

require_once(__DIR__ . '/feed.php');

$feed = new Feed('http://www.phpdeveloper.org/feed');

$items = $feed->getItems();

if($feed->didLoad()) {
    echo '<p><b>Loading feed from: '.$feed->getUrl().'</b></p>'."\n";
}

foreach( $items as $item ) {
    echo '<p><a href="'.$item['link'].'">'.$item['title'].'</a></p>'."\n";
}

/*i*/ FirePHP::to('request')->console('Feed')->info('Shutdown');
