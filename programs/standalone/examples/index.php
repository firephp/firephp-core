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
            TABLE {
                margin: 0px;
                padding: 0px;
            }
            IFRAME {
                border: 0px;
                border-collapse: collapse;
                overflow: hidden;
            }
            TD.menu {
                background-color: #ececec;
                font-size: 13px;
            }
            SPAN.label {
                font-weight: bold;
                padding-right: 10px;
            }
        </style>
    </head>
    <body>
        <table width="100%" height="100%">
            <tr>
                <td class="menu" nowrap valign="top" style="padding: 10px;">
                    <span class="label">FirePHP Examples:</span>
                    <a href="FeedCache/index.php" target="examples">FeedCache</a>
                    |
                    <a href="Quickstart/index.php" target="examples">Quickstart</a>
                    |
                    <a href="TestRunner/index.php" target="examples">TestRunner</a>
                    <?php
                        // If Zend Framework is available
                        $PINF_HOME = isset($_SERVER['PINF_HOME']) ? $_SERVER['PINF_HOME'] : '/pinf';
                        if(is_dir($PINF_HOME)) {
                            $path = $PINF_HOME . '/workspaces/framework.zend.com/svn/framework/standard/trunk';
                            if(is_dir($path . '/demos/Zend/Wildfire/public') &&
                               is_dir($path . '/library/Zend/Wildfire')) {
                                echo '| <a href="ZendFramework/index.php" target="examples">Zend Framework</a>';
                            }
                        }
                    ?>
                    <?php
                        // If firephp/ui-plugins are available
                        $PINF_HOME = isset($_SERVER['PINF_HOME']) ? $_SERVER['PINF_HOME'] : '/pinf';
                        if(is_dir($PINF_HOME)) {
                            $path = $PINF_HOME . '/workspaces/github.com/firephp/ui-plugins';
                            if(!is_dir($path)) {
                                // HACK
                                $path = '/pinf/programs/com.developercompanion.reference/packages/firephp-ui-plugins';
                            }
                            if(is_dir($path)) {
                                echo '| <a href="UIPlugins/index.php" target="examples">UI Plugins</a>';
                            }
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td valign="top" height="100%">
                    <iframe id="examples-frame" name="examples" width="100%" height="100%" src=""></iframe> 
                </td>
            </tr>
        </table>
    </body>
</html>