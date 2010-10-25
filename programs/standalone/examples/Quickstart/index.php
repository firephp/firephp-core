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
                        
                    <p>Requires <a href="http://www.christophdorn.com/Tools/#FirePHP Companion" target="_blank">FirePHP Companion</a></p>

                    <p><b>NOTE:</b> If you have <a target="_blank" href="http://getfirebug.com/">Firebug</a> installed make<br/>sure you have the <i>Net</i> and <i>Insight</i> panel enabled.</p>

                    <ul>
                        <?php
                        $items = array();
                        foreach( new DirectoryIterator(dirname(__FILE__)) as $dir ) {
                            if($dir->isFile()
                               && substr($dir->getBasename(), -4, 4)==".php"
                               && $dir->getBasename()!="_init_.php"
                               && $dir->getBasename()!="index.php"
                               && $dir->getBasename()!="ServerScript.php") {

                                $items[$dir->getBasename()] = '<li><a target="content" href="'.$dir->getBasename().'">'.substr($dir->getBasename(), 0, -4).'</a></li>';
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
