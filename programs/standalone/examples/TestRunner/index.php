<?php

/* NOTE: You must have the FirePHP library on your include path */
$libPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME']))) . DIRECTORY_SEPARATOR . "lib";

$includePath = explode(PATH_SEPARATOR, get_include_path());
if(!in_array($libPath, $includePath)) {
    array_unshift($includePath, $libPath);
    set_include_path(implode(PATH_SEPARATOR, $includePath));
}

function _getallheaders() {
    $headers = array();
    if(function_exists('getallheaders')) {
        foreach( getallheaders() as $name => $value ) {
            $headers[strtolower($name)] = $value;
        }
    } else {
        foreach($_SERVER as $name => $value) {
            if(substr($name, 0, 5) == 'HTTP_') {
                $headers[strtolower(str_replace(' ', '-', str_replace('_', ' ', substr($name, 5))))] = $value;
            }
        }
    }
    return $headers;
}

$returnRaw = false;

function RETURN_RAW() {
    global $returnRaw;
    $returnRaw = true;    
}

// handle actions
$action = (isset($_GET['action']))?$_GET['action']:false;
switch($action) {
    case 'run':

        ob_start();

        $profilingInfo = array();
        $initFile = false;
        $file = false;
    	
        $snippet = (isset($_GET['snippet']))?$_GET['snippet']:false;
        if($snippet) {
            $file = dirname(__FILE__) . DIRECTORY_SEPARATOR . $snippet . ".php";
        } else {
            $initFile = dirname(__FILE__) . DIRECTORY_SEPARATOR . $_GET['set'] . DIRECTORY_SEPARATOR . '_init_.php';
            $file = dirname(__FILE__) . DIRECTORY_SEPARATOR . $_GET['set'] . DIRECTORY_SEPARATOR . $_GET['file'];
        }

        // Include init file
        if($initFile) {
            $profilingInfo['init-start'] = microtime(true);
            require_once($initFile);
            $profilingInfo['init-end'] = microtime(true);
        }
        
        renderHeader();
        $html = array();
        $html[] = '<style>';
        $html[] = 'BODY { overflow: auto; }';
        $html[] = '</style>';
        echo implode("\n",$html);

        // Print out profiling info
        $html = array();
        $html[] = '<div id="profiling-info" class="box">';
        $html[] = '<div class="body" style="display: block; padding-top: 0px;">';
        $html[] = 'Init: <span id="time-init" class="number"></span> Example: <span id="time-example" class="number"></span> ';
        $html[] = '</div>';
        $html[] = '</div>';
        echo implode("\n",$html);

        // Print all headers received
        $html = array();
        $html[] = '<div class="box">';
        $html[] = '<div class="header">';
        $html[] = 'getallheaders()';
        $html[] = '</div>';
        $html[] = '<div id="request-headers-body" class="body">';
        foreach( _getallheaders() as $name => $value ) {
            $html[] = $name . ': ' . $value . '<br/>';
        }
        $html[] = '</div>';
        $html[] = '</div>';
        echo implode("\n",$html);

        // Print out init file
        if($initFile) {
            $html = array();
            $html[] = '<div class="code">';
            $html[] = '<div class="header">';
            $html[] = $_GET['set'] . DIRECTORY_SEPARATOR . '_init_.php';
            $html[] = '</div>';
            $html[] = '<div class="body">';
            echo implode("\n",$html);
            highlight_file($initFile);
            echo '</div>';
            echo '</div>';
    
            // Show all included files
            $html = array();
            $html[] = '<div class="box">';
            $html[] = '<div class="header">';
            $html[] = 'get_included_files() after init';
            $html[] = '</div>';
            $html[] = '<div id="included-files-init" class="body">';
            $initFiles = get_included_files();
            foreach( $initFiles as $f ) {
                $html[] = trimFilePath($f) . '<br/>';
            }      
            $html[] = '</div>';
            $html[] = '</div>';
            echo implode("\n",$html);
        }

        // Print out test file
        $html = array();
        $html[] = '<div class="code">';
        $html[] = '<div class="header">';
        $html[] = trimFilePath($file);
        $html[] = '</div>';
        $html[] = '<div class="body">';
        echo implode("\n",$html);
        if(file_exists($file)) {
            highlight_file($file);
        } else {
            print('<span style="color: red;">FILE NOT FOUND</span>');
        }
        echo '</div>';
        echo '</div>';
        
        $headerHarness = ob_get_clean();
        
        ob_start();
      
        // Include test file
        $profilingInfo['example-start'] = microtime(true);
        if(file_exists($file)) {
            require_once($file);
        }
        $profilingInfo['example-end'] = microtime(true);
        
        $bodyData = ob_get_clean();
        
        ob_start();

        // Show all included files
        if($initFile) {
            $html = array();
            $html[] = '<div class="box">';
            $html[] = '<div class="header">';
            $html[] = 'Additional get_included_files() after example';
            $html[] = '</div>';
            $html[] = '<div id="included-files-example" class="body">';
            $exampleFiles = get_included_files();
            foreach( array_diff($exampleFiles, $initFiles) as $f ) {
                $html[] = trimFilePath($f) . '<br/>';
            }      
            $html[] = '</div>';
            $html[] = '</div>';
            echo implode("\n",$html);
        } else {
            $html = array();
            $html[] = '<div class="box">';
            $html[] = '<div class="header">';
            $html[] = 'get_included_files()';
            $html[] = '</div>';
            $html[] = '<div id="included-files" class="body">';
            foreach( get_included_files() as $f ) {
                $html[] = trimFilePath($f) . '<br/>';
            }      
            $html[] = '</div>';
            $html[] = '</div>';
            echo implode("\n",$html);
        }
        
        // flush headers now if applicable
        if(class_exists('Insight_Helper', false)) {
            $insight = Insight_Helper::getInstance();
            if($insight->getEnabled()) {
                $insight->getDispatcher()->getChannel()->flush();
            }
        }
        
        // Print all headers to be sent
        $html = array();
        $html[] = '<div class="box">';
        $html[] = '<div class="header">';
        $html[] = 'headers_list()';
        $html[] = '</div>';
        $html[] = '<div id="response-headers-body" class="body">';
        foreach( headers_list() as $header ) {
            $html[] = $header . '<br/>';
        }
        $html[] = '</div>';
        $html[] = '</div>';
        echo implode("\n",$html);

        // Print payload to be fetched by client if applicable
        if(class_exists('Insight_Helper', false)) {
            $insight = Insight_Helper::getInstance();
            if($insight->getEnabled()) {
                $html = array();
                $html[] = '<div class="box">';
                $html[] = '<div class="header">';
                $html[] = 'Payload';
                $html[] = '</div>';
                $html[] = '<div id="payload-body" class="body">';
                $transport = $insight->getChannel()->getTransport();
                $contents = $transport->getData($transport->getLastKey());
                $contents = str_replace("\n", '<br/>', $contents);
                $html[] = $contents;
                $html[] = '</div>';
                $html[] = '</div>';
                echo implode("\n",$html);
            }
        }

        if(isset($profilingInfo['init-start']) && isset($profilingInfo['init-end'])) {
            $profilingInfo['init'] = round($profilingInfo['init-end'] - $profilingInfo['init-start'], 5);
        }
        $profilingInfo['example'] = round($profilingInfo['example-end'] - $profilingInfo['example-start'], 5);

        $html = array();
        $html[] = '<script>';
        $html[] = 'profilingInfo = ' . ((function_exists('json_encode'))?json_encode($profilingInfo):'{}') . ';';
        $html[] = '</script>';
        echo implode("\n",$html);

        renderFooter();
        
        $footerHarness = ob_get_clean();

        if($returnRaw) {
            echo $bodyData;
        } else {
            echo $headerHarness;
            echo $bodyData;
            echo $footerHarness;
        }
    	break;
    default:
        require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'insight-devcomp' . DIRECTORY_SEPARATOR . '_init_.php');
        renderHeader();
        renderFrameset();
        renderFooter();
        break;
}

function renderHeader() {
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
            .success {
                color: green;
                font-weight: bold;
                font-size: 14px;
            }
            DIV.box {
                background-color: #efefef;
                border: 1px solid #cecece;
                padding: 5px;
                padding-top: 0px;
                padding-bottom: 0px;
                margin: 5px;
                overflow-x: auto;
                white-space: nowrap;
                text-align: right;
            }
            DIV.box DIV.body {
                display: none;
                padding-top: 3px;
                padding-bottom: 5px;
                text-align: left;
            }
            DIV.code {
                background-color: #efefef;
                border: 1px solid #cecece;
                padding: 5px;
                margin: 5px;
                padding-top: 0px;
                overflow-x: auto;
                white-space: nowrap;
                text-align: right;
            }
            DIV.code DIV.body {
                text-align: left;
            }
            DIV.header {
                border-bottom: 1px dotted #cecece;
                margin-bottom: 2px;
                display: inline-block;
                cursor: pointer;
            }
            #profiling-info {
                padding-top: 5px;
            }
            SPAN.number {
                font-weight: bold;
                padding-right: 10px;
            }
            DIV.ui-layout-west {
                padding: 10px;
                overflow-y: scroll;
            }
        </style>
        <script src="jquery-1.4.2.min.js"></script>
        <script src="jquery.layout-1.3.0.js"></script>
        <script>
            var profilingInfo;
            $(document).ready(function() {
                $("A.ajax").bind("click", function(event) {
                    var obj = $(this),
                        href = obj.attr("href").substring(1),
                        parts = href.split("/"),
                        method = "GET";
                    if(href=="insight-devcomp/RequestConsole-PostTest.php") {
                        method = "POST";
                    }
                    $.ajax({
                        "url": "?x-insight=inspect&action=run&set=" + parts[0] + "&file=" + parts[1],
                        "type": method,
                        "data": {
                            "sample": "data"
                        },
                        "success": function(data) {

                            var doc = $("#content-frame")[0].contentDocument;
                            doc.open();
                            doc.write(data);
                            doc.close();

                            obj.addClass("success");
                            setTimeout(function() {
                                obj.removeClass("success");
                            }, 2000);
                        }
                    });
                });
                if(profilingInfo && profilingInfo["init"]) {
                    $("#time-init").html(profilingInfo["init"]);
                } else {
                    $("#time-init").html("?");
                }
                if(profilingInfo && profilingInfo["example"]) {
                    $("#time-example").html(profilingInfo["example"]);
                } else {
                    $("#time-example").html("?");
                }
                if(window.parent && window.parent.$ && window.parent.$("#option-show-headers").is(":checked")) {
                    $("#request-headers-body").show();
                    $("#response-headers-body").show();
                }
                if(window.parent && window.parent.$ && window.parent.$("#option-show-included-files").is(":checked")) {
                    $("#included-files-init").show();
                    $("#included-files-example").show();
                }
                if(window.parent && window.parent.$ && window.parent.$("#option-show-payload").is(":checked")) {
                    $("#payload-body").show();
                }
                $("DIV.box DIV.body").each(function() {
                    var obj = $(this);
                    if(!obj.is(":visible")) {
                        $("DIV.header", obj.parent()).bind("click", function() {
                            if(obj.is(":visible")) {
                                obj.slideUp("fast");
                            } else {
                                obj.slideDown("fast");
                            }
                        });
                    }
                });
            });
        </script>
    </head>
    <body>
<?php
}
function renderFrameset() {
?>
    <script>
        $(document).ready(function() {
            $('body').layout({
                "west": {
                    "size": "300",
                    "resizable": false,
                    "slidable": false,
                    "closable": false,
                    "spacing_open": 0
                },
                "center": {
                },
            });
        });
    </script>
    <div class="ui-layout-west">
        
        <p>Source: <a target="_blank" href="https://github.com/cadorn/firephp-libs/tree/master/programs/standalone/examples/">github.com/cadorn/firephp-libs</a></p>
        
        <table border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td><input type="checkbox" id="option-show-headers"/></td>
                <td>Show Headers</td>
            </tr>
            <tr>
                <td><input type="checkbox" id="option-show-included-files"/></td>
                <td>Show Included Files</td>
            </tr>
            <tr>
                <td><input type="checkbox" id="option-show-payload"/></td>
                <td>Show Payload</td>
            </tr>
        </table>
            
        <h1>Classic FirePHP to Firebug Console</h1>
        <p>Requires <a href="http://www.firephp.org/" target="_blank">FirePHP Extension</a> or <a href="http://www.christophdorn.com/Tools/#FirePHP Companion LITE" target="_blank">FirePHP Companion LITE</a></p>
        <ul>
            <?php
            $items = array();
            foreach( scandir(dirname(__FILE__).DIRECTORY_SEPARATOR.'classic-firebug') as $dir ) {
                if(is_file(dirname(__FILE__).DIRECTORY_SEPARATOR.'classic-firebug'.DIRECTORY_SEPARATOR.$dir)
                   && $dir!='_init_.php' && substr($dir,0,5)!=".tmp_"
                   && $dir!='RedirectTarget.php') {
                    $items[$dir] = '<li><a target="content" href="?x-insight=activate&action=run&set=classic-firebug&file='.$dir.'">'.substr($dir, 0, -4).'</a></li>';
                }
            }
            ksort($items);
            echo implode("\n", $items);
            ?>
            <li><a class="ajax" href="#classic-firebug/AllVariableTypes.php">AJAX Test</a></li>
        </ul>
        <p>Snippets:</p>
        <ul>
            <?php
            $items = array();
            foreach( scandir(dirname(__FILE__).DIRECTORY_SEPARATOR.'classic-firebug/snippets') as $dir ) {
                if(is_file(dirname(__FILE__).DIRECTORY_SEPARATOR.'classic-firebug/snippets'.DIRECTORY_SEPARATOR.$dir)
                   && substr($dir,0,5)!=".tmp_") {
                    $items[$dir] = '<li><a target="content" href="?x-insight=activate&action=run&snippet=classic-firebug/snippets/'.substr($dir, 0, -4).'">'.substr($dir, 0, -4).'</a></li>';
                }
            }
            ksort($items);
            echo implode("\n", $items);
            ?>
        </ul>

        <h1>Insight FirePHP to FirePHP Companion</h1>
        <p>Requires <a href="http://www.christophdorn.com/Tools/#FirePHP Companion" target="_blank">FirePHP Companion</a></p>
        <ul>
            <?php
            $items = array();
            foreach( scandir(dirname(__FILE__).DIRECTORY_SEPARATOR.'insight-devcomp') as $dir ) {
                if(is_file(dirname(__FILE__).DIRECTORY_SEPARATOR.'insight-devcomp'.DIRECTORY_SEPARATOR.$dir)
                   && $dir!='_init_.php' && substr($dir,0,5)!=".tmp_"
                   && $dir!='PageConsole-RedirectTarget.php'
                   && $dir!='RequestConsole-RedirectTarget.php') {
                    $inspect = "x-insight=inspect&";
                    if($dir=="RequestConsole-AutoInspect.php" ||
                       $dir=="RequestConsole-ManualInspect.php" ||
                       $dir=="RequestConsole-InspectHeader.php" ||
                       substr($dir, 0, 11)=="PageConsole" ||
                       substr($dir, 0, 12)=="PageControls") {
                        $inspect = "x-insight=activate&";
                    }
                    if($dir=="RequestConsole-PostTest.php") {
                        $items[$dir] = '<li><a class="ajax" href="#insight-devcomp/RequestConsole-PostTest.php">RequestConsole-PostTest</a></li>';
                    } else {
                        $items[$dir] = '<li><a target="content" href="?' . $inspect . 'action=run&set=insight-devcomp&file='.$dir.'">'.substr($dir, 0, -4).'</a></li>';
                    }
                }
            }
            ksort($items);
            echo implode("\n", $items);
            ?>
        </ul>
        <p>Snippets:</p>
        <ul>
            <?php
            $items = array();
            foreach( scandir(dirname(__FILE__).DIRECTORY_SEPARATOR.'insight-devcomp/snippets') as $dir ) {
                if(is_file(dirname(__FILE__).DIRECTORY_SEPARATOR.'insight-devcomp/snippets'.DIRECTORY_SEPARATOR.$dir)
                   && substr($dir,0,5)!=".tmp_") {
                    $items[$dir] = '<li><a target="content" href="?x-insight=activate&action=run&snippet=insight-devcomp/snippets/'.substr($dir, 0, -4).'">'.substr($dir, 0, -4).'</a></li>';
                }
            }
            ksort($items);
            echo implode("\n", $items);
            ?>
        </ul>
    </div>
    <div class="ui-layout-center">
        <iframe id="content-frame" name="content" width="100%" height="100%" src=""></iframe> 
    </div>
<?php
}
function renderFooter() {
?>
    </body>
</html>
<?php
}

function trimFilePath($path) {
    if(substr($path, 0, strlen(dirname(__FILE__)))==dirname(__FILE__)) {
        return "..." . substr($path, strlen(dirname(__FILE__)));
    }
    return $path;
}
