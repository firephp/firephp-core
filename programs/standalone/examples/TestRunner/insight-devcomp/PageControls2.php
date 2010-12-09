<?php

$plugins = FirePHP::to("plugin"); 

$plugin = $plugins->plugin('PageControls2');

$plugin->register(array(
    'class' => 'FirePHP_Examples_PageControls2_Plugin',
    'file' => dirname(__FILE__) . '/plugins/PageControls2/lib/Plugin.php',
    'forceReload' => true
));

$plugin->show();
