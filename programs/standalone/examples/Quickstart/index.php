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
                        
                    <p>Requires <a href="http://companion.firephp.org/" target="_blank">FirePHP Companion</a></p>

                    <ul>
                        <?php
                        foreach( new DirectoryIterator(dirname(__FILE__)) as $dir ) {
                            if($dir->isFile()
                               && substr($dir->getBasename(), -4, 4)==".php"
                               && $dir->getBasename()!="_init_.php"
                               && $dir->getBasename()!="index.php"
                               && $dir->getBasename()!="ServerScript.php") {

                                print '<li><a target="content" href="'.$dir->getBasename().'">'.substr($dir->getBasename(), 0, -4).'</a></li>';
                            }
                        }
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
