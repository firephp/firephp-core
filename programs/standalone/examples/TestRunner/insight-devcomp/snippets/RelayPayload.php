<?php

// NOTE: You must have FirePHP Companion installed (http://www.christophdorn.com/Tools/)

// See Firebug Console for result

define('INSIGHT_CONFIG_PATH', dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'package.json');
require_once('FirePHP/Init.php');

$payload = array();
$payload[] = 'x-wf-protocol-1: http://registry.pinf.org/cadorn.org/wildfire/@meta/protocol/component/0.1.0';
$payload[] = 'x-wf-1-index: 3';
$payload[] = 'x-wf-1-1-receiver: http://registry.pinf.org/cadorn.org/insight/@meta/receiver/insight/package/0';
$payload[] = 'x-wf-1-1-1-sender: http://registry.pinf.org/cadorn.org/github/firephp-libs/programs/standalone/examples/TestRunner/?lib=cadorn.org/github/firephp-libs/packages/insight@' . FirePHP::VERSION;
$payload[] = 'x-wf-1-1-1-1: 350|{"target":"info"}|{"links":{"quick":{"Homepage":"http:\/\/github.com\/cadorn\/firephp-libs\/tree\/master\/programs\/standalone\/examples\/","Bugs":"http:\/\/github.com\/cadorn\/firephp-libs\/issues","Discuss":"http:\/\/groups.google.com\/group\/firephp-dev","Follow":"http:\/\/twitter.com\/firephplib"}},"description":"FirePHP Examples: Test Runner"}|';
$payload[] = 'x-wf-1-2-receiver: http://registry.pinf.org/cadorn.org/insight/@meta/receiver/insight/controller/0';
$payload[] = 'x-wf-1-2-1-sender: http://registry.pinf.org/cadorn.org/github/firephp-libs/programs/standalone/examples/TestRunner/?lib=cadorn.org/github/firephp-libs/packages/insight@' . FirePHP::VERSION;
$payload[] = 'x-wf-1-2-1-2: 125||{"serverUrl":"http:\/\/reference.developercompanion.com\/Tools\/FirePHPCompanion\/Run\/Examples\/TestRunner\/_insight_.php"}|';
$payload[] = 'x-wf-1-3-receiver: http://registry.pinf.org/cadorn.org/insight/@meta/receiver/console/page/0';
$payload[] = 'x-wf-1-3-1-sender: http://registry.pinf.org/cadorn.org/github/firephp-libs/programs/standalone/examples/TestRunner/?lib=cadorn.org/github/firephp-libs/packages/insight@' . FirePHP::VERSION;
$payload[] = 'x-wf-1-3-1-3: 386|{"context":"page","target":"console","priority":"log","file":"\/Users\/cadorn\/pinf\/workspaces\/github.com\/cadorn\/firephp-libs\/programs\/standalone\/examples\/TestRunner\/insight-devcomp\/snippets\/PayloadListener.php","line":33,"lang.id":"registry.pinf.org\/cadorn.org\/github\/renderers\/packages\/php\/master"}|{"origin":{"type":"text","text":"Hello World","lang.type":"string"}}|';

Insight_Helper::getInstance()->relayPayload(implode("\n", $payload));
