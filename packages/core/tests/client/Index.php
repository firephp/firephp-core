<?php

/* NOTE: You must have the FirePHPCore library in your include path */
set_include_path('./../../lib/'.PATH_SEPARATOR.get_include_path());
require('FirePHPCore/fb.php');

switch($_GET['action']) {
    case 'test':
        $file = dirname(__FILE__).DIRECTORY_SEPARATOR.'client'.DIRECTORY_SEPARATOR.$_GET['file'];

        // Start output buffering
      
        ob_start();
      
        // Display some info to confirm the library we are using
      
        $html = array();
        $html[] = '<div style="margin: 10px; padding: 10px; border: 1px solid #B7B7B7; background-color: #bbbbbb; font-family: verdana,arial,helvetica,sans-serif; font-size: 80%;">';
        $html[] = 'Test: <span style="color: white; font-weight: bold;">'.$_GET['file'].'</span>';
        $html[] = '</div>';
        echo implode("\n",$html);
            
        // Print out test file
      
        highlight_file($file);
      
        // Show all included files
      
        $html = array();
        $html[] = '<table><tr><td nowrap style="color: white; margin: 10px; padding: 10px; border: 1px solid #B7B7B7; background-color: #bbbbbb; font-family: verdana,arial,helvetica,sans-serif; font-size: 80%;">';
        foreach( get_included_files() as $f ) {
            $html[] = $f . '<br/>';
        }      
        $html[] = '</td></tr></table>';
        echo implode("\n",$html);
      
        // Include test file
      
        require_once($file);
        
        // Print all headers to be sent
        
        $html = array();
        $html[] = '<table><tr><td nowrap style="color: white; margin: 10px; padding: 10px; border: 1px solid #B7B7B7; background-color: #bbbbbb; font-family: verdana,arial,helvetica,sans-serif; font-size: 80%;">';
        foreach( headers_list() as $header ) {
            $html[] = $header . '<br/>';
        }
        $html[] = '</td></tr></table>';
        echo implode("\n",$html);
      
    	break;
    default:
        renderFrameset();
        break;
}

function renderFrameset() {
?>
<html>
    <head>
        <style>
            HTML, BODY {
                width: 99%;
                height: 99%;
                font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
                margin: 0px;
                padding: 0px;
            }
            P, TD {
                font-size: 10px;
            }
            .success {
                color: green;
                font-weight: bold;
                font-size: 14px;
            }
        </style>
        <script src="http://www.google.com/jsapi"></script>
        <script>
            google.load("jquery", "1");
            google.setOnLoadCallback(function() {
                $(document).ready(function() {
                    $("#testAjax").bind("click", function(event) {
                        $.ajax({
                          url: 'ClientTests.php?action=test&file=AllVariableTypes.php',
                          success: function(data) {
                              $("#testAjax").addClass("success");
                              
                              setTimeout(function() {
                                  $("#testAjax").removeClass("success");
                              }, 2000);
                          }
                        });
                    });
                });
            });
        </script>
    </head>
    <body>
        <table width="100%" height="100%">
            <tr>
                <td width="30%" nowrap valign="top" style="padding: 10px;">
                    <?php
                    foreach( new DirectoryIterator(dirname(__FILE__).DIRECTORY_SEPARATOR."client") as $dir ) {
                        if($dir->isFile() && substr($dir->getBasename(),0,5)!=".tmp_") {
                            print '<p><a target="content" href="?action=test&file='.$dir->getBasename().'">'.$dir->getBasename().'</a></p>';
                        }
                    }
                    ?>
                    
                    <hr>
                    
                    <a id="testAjax" href="#">AjaxTest</a>
                    
                </td>
                <td width="70%" valign="top">
                    <iframe name="content" width="100%" height="100%" src=""></iframe> 
                </td>
            </tr>
        </table>
    </body>
</html>
<?php
}
