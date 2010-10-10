<?php

$available = false;

// If Zend Framework is available
$PINF_HOME = isset($_SERVER['PINF_HOME']) ? $_SERVER['PINF_HOME'] : '/pinf';
if(is_dir($PINF_HOME)) {
    $path = $PINF_HOME . '/workspaces/framework.zend.com/svn/framework/standard/trunk';
    if(is_dir($path . '/demos/Zend/Wildfire/public') &&
       is_dir($path . '/library/Zend/Wildfire')) {

        $available = true;
    }
}

if($available) {

    // NOTE: If demos/Zend/Wildfire/public/.htaccess gets more complicated this needs to be revised

    $uri = substr($_SERVER['REQUEST_URI'], 51);
    
    if(substr($uri, 0, 5)=='Boot/') {
        
        $uri_info = parse_url($uri);

        require_once($path . '/demos/Zend/Wildfire/public/' . $uri_info['path']);

    } else {
        
        require_once($path . '/demos/Zend/Wildfire/public/index.php');
        
    }

} else {
    ?>

<p>Zend Framework not found at: <?php echo $path; ?></p>

    <?php
}
