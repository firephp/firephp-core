<?php

$available = false;

// If firephp/ui-plugins is available
$PINF_HOME = isset($_SERVER['PINF_HOME']) ? $_SERVER['PINF_HOME'] : '/pinf';
if(is_dir($PINF_HOME)) {
    $path = $PINF_HOME . '/workspaces/github.com/firephp/ui-plugins';
    if(!is_dir($path)) {
        // HACK
        $path = '/pinf/programs/com.developercompanion.reference/packages/firephp-ui-plugins';
    }
    if(is_dir($path)) {
        $available = true;
    }
}

if($available) {
    
    if(isset($_GET['action']) && $_GET['action']=='run') {
        
        if(isset($_GET['test'])) {
            $file = realpath($path.DIRECTORY_SEPARATOR.'packages'.DIRECTORY_SEPARATOR.$_GET['plugin'].DIRECTORY_SEPARATOR.'tests'.DIRECTORY_SEPARATOR.'php'.DIRECTORY_SEPARATOR.'FirePHPTest'.DIRECTORY_SEPARATOR.$_GET['test']);
            if(!$file || !is_file($file)) {
                echo 'Test "' . $_GET['test'] . '" for plugin "' . $_GET['plugin'] . '" not found!';
                return;
            }
            require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . '_insight_.php');
            require_once($file);
            highlight_file($file);
        } else {
            $file = realpath($path.DIRECTORY_SEPARATOR.'packages'.DIRECTORY_SEPARATOR.$_GET['plugin'].DIRECTORY_SEPARATOR.'tests'.DIRECTORY_SEPARATOR.'php'.DIRECTORY_SEPARATOR.'FirePHPTest.inc.php');
            if(!$file || !is_file($file)) {
                echo 'Plugin "' . $_GET['plugin'] . '" not found!';
                return;
            }
            require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . '_insight_.php');
            require_once($file);
            highlight_file($file);
            // render additional test links
            $html = array();
            $html[] = '<hr>';
            $html[] = '<ul>';
            $path = dirname($file) . DIRECTORY_SEPARATOR . 'FirePHPTest';
            if(is_dir($path)) {
                foreach( scandir($path) as $dir  ) {
                    if(is_file($path.DIRECTORY_SEPARATOR.$dir) && $dir{0}!=".") {
                        $html[] = '<li><a target="content" href="?action=run&plugin='.$_GET['plugin'].'&test='.$dir.'">'.$dir.'</a></li>';
                    }
                }
            }
            $html[] = '</ul>';
            echo implode("\n", $html);
        }
        return;
    }
?>

<html>
    <head>
        <style>
            HTML, BODY {
                width: 100%;
                height: 100%;
                margin: 0px;
                padding: 0px;
                overflow: hidden;
            }
            BODY, P, TD {
                font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
                font-size: 10px;
            }
            H1 {
                font-size: 12px;
            }
        </style>
    </head>
    <body>
        <table width="100%" height="100%">
            <tr>
                <td width="20%" nowrap valign="top" style="padding: 10px;">

                    <p>Requires <a target="_blank" href="http://getfirebug.com/">Firebug</a> and <a target="_blank" href="http://www.christophdorn.com/Tools/#FirePHP Companion LITE">FirePHP Companion LITE</a>.<br/>
                    Make sure you have the <i>Firebug Console</i> and <i>Insight</i><br/>panels enabled!</p>

                    <p>See <a target="_blank" href="https://github.com/firephp/ui-plugins">here</a> for documentation.</p>

                    <ul>
                        <?php
                        $items = array();
                        foreach( scandir($path.DIRECTORY_SEPARATOR.'packages') as $dir  ) {
                            if(is_dir($path.DIRECTORY_SEPARATOR.'packages'.DIRECTORY_SEPARATOR.$dir)) {
                                $file = $path.DIRECTORY_SEPARATOR.'packages'.DIRECTORY_SEPARATOR.$dir.DIRECTORY_SEPARATOR.'tests'.DIRECTORY_SEPARATOR.'php'.DIRECTORY_SEPARATOR.'FirePHPTest.inc.php';
                                if(is_file($file)) {
                                    $items[$dir] = '<li><a target="content" href="?action=run&plugin='.$dir.'">'.$dir.'</a></li>';
                                }
                            }
                        }
                        echo implode("\n", $items);
                        ?>
                    </ul>
                </td>
                <td width="80%" valign="top">
                    <iframe id="content-frame" name="content" width="100%" height="100%" src=""></iframe> 
                </td>
            </tr>
        </table>
    </body>
</html>

<?php
} else {
?>

<p><a target="_blank" href="https://github.com/firephp/ui-plugins">https://github.com/firephp/ui-plugins</a> not found at: <?php echo $path; ?></p>

<?php
}
