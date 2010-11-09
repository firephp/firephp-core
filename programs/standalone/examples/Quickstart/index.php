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

                    <p><a target="_blank" href="http://reference.developercompanion.com/#/Tools/FirePHPCompanion/Quickstart/">Download &amp Install</a> Quickstart Examples</p>

                    <p>Requires <a target="_blank" href="http://getfirebug.com/">Firebug</a> and <a target="_blank" href="http://www.christophdorn.com/Tools/#FirePHP Companion LITE">FirePHP Companion LITE</a>.<br/>
                    Make sure you have the <i>Firebug Console</i> and <i>Insight</i><br/>panels enabled!</p>

                    <ul>
                        <?php
                        $items = array();
                        foreach( scandir(dirname(__FILE__)) as $dir ) {
                            if(is_file(dirname(__FILE__).DIRECTORY_SEPARATOR.$dir)
                               && substr($dir, -4, 4)==".php"
                               && $dir!="_init_.php"
                               && $dir!="index.php"
                               && $dir!="ServerScript.php") {

                                $items[$dir] = '<li><a target="content" href="'.$dir.'">'.substr($dir, 0, -4).'</a></li>';
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
