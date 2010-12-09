<?php

$plugins = FirePHP::to("plugin"); 

$plugin = $plugins->plugin('PageControls1');

$plugin->register(array(
    'class' => 'FirePHP_Examples_PageControls1_Plugin',
    'file' => dirname(__FILE__) . '/plugins/PageControls1/lib/Plugin.php',
    'forceReload' => true
));
