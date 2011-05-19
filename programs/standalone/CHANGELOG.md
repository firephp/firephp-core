
TODO:

// LOW

  * Bugfix: Trimmed headers - http://framework.zend.com/issues/browse/ZF-7664
  * Enhancement: (cli) phpunit wrapper
  * Enhancement: (cli) nice variable printing to terminal via ::to('terminal')
  * Bugfix: Tests directories in zip distribution

// MEDIUM

  * Enhancement: Port unit tests & get working properly via phpunit and logging to devcomp
  * Enhancement: FirePHP 1.0 via pear.firephp.org
  * Enhancement: Get FirePHP for Zend Server up to speed
  * Enhancement: Support Firebug LITE
  * Enhancement: pear package for easy install of FirePHP 1.0 on ZendServer
  * Incorporate: http://till.klampaeckel.de/blog/archives/120-Tracking-PHP-errors.html
  * Enhancement: Plugin library and example for http://vis.stanford.edu/protovis/

// HIGH

  * Bugfix: Do not send page context messages if receiver is not announced
  * Change: Send headers at beginning of script to avoid need for output buffering
  * Enhancement: Add more quickstart examples
  * Bugfix: Recognize ../ paths as relative (not just ./)
  * Enhancement: Set color and background color of messages
  * Enhancement: Autoloader support
  * Enhancement: Use of namespaces internally (released in parallel to non-namespaced release (FirePHP < 5.3))

// TOP

  * Enhancement: Proxy data from service calls to client
  * Enhancement: Add new ->ok()-> message priority
  * Bugfix: Wrap ZF classes to avoid redeclaration (specifically needed until autoloader and external ZF issues resolved)

  * Docs: Deprecate FirePHP_Plugin_FirePHP::trapProblems()
  * Docs: Deprecate FirePHP_Plugin_Engine::*

DONE:

  * Change: Escaping in protocol for pipes
  * Change: More robust and hierarchical on()
  * Bugfix: open/close for on()

2011-05-16 - Release Version: 0.0.0master1105161440

  * Enhancement: Better deprecation notices
  * Bugfix: Better filtering of get_included_files() to remove FirePHP related
  * Bugfix: Assertion error logs two messages
  * Bugfix: Ensure JSON keys are never NULL (due to NULL key in some arrays) for FirePHPCore

2011-05-13 - Release Version: 0.0.0master1105131750

  * Bugfix: Default to 'log' priority without setting meta
  * Change: Deprecated FirePHP_Plugin_FirePHP::trapProblems()
  * Change: Deprecated FirePHP_Plugin_Engine::*
  * Enhancement: Send included files for every request

2011-05-10 - Release Version: 0.0.0master1105101636

  * Change: Updated TestRunner descriptor [10m]

2011-05-10 - Release Version: 0.0.0master1105101539

  * Bugfix: Exception if FIREPHP_ACTIVATED is set and ->on() is used [15m]
  * Change: Do not send server URL all the time [5m]
  * Enhancement: Send package info only if changed [20m]

2011-04-30 - Release Version: 0.0.0master1104301030

  * Bugfix: INSIGHT_CONFIG_PATH detection and validation regression (was failing for minimal install) [10m]

2011-03-11 - Release Version: 0.0.0master1103111119

  * Enhancement: Better error messages when INSIGHT_DEBUG enabled [20m]
  * Bugfix: Depth trimming [1h30m]

2011-03-04 - Release Version: 0.0.0master1103041120

  * Enhancement: Example APF-based (ajax.org) plugin (working but clunky - not usable) [6h]
  * Enhancement: Example ExtJS-based plugin [30m]
  * Bugfix: INSIGHT_CONFIG_PATH delimiter conflicting with windows drive separator ':'
  * Bugfix: More reliable string encoding detection (Issue 166)

2011-01-05 - Release Version: 0.0.0master1101051613

  * Bugfix: Set second arg FALSE for class_exists() to bypass autoloaders [12m]
  * Bugfix: Insight-specific global variable cleanup during initialization [3m]
  * Enhancement: Specify credentials.json path via INSIGHT_CONFIG_PATH by suffixing with ':<PATH>' [12m]

2010-12-16 - Release Version: 0.0.0master1012161631

  * Bugfix: Use $_SERVER['HTTP_X_FORWARDED_FOR'] over $_SERVER['REMOTE_ADDR'] if set [5m]

2010-12-14 - Release Version: 0.0.0master1012142034

  * Enhancement: API to add quicklinks [27m]
  * Enhancement: Pass custom trace to trace($title, $trace=null) [5m]
  * Enhancement: Lazy loading of plugin files

2010-12-09 - Release Version: 0.0.0master1012091510

  * Enhancement: Validate characters for plugin aliases [6m]
  * Enhancement: Validate characters for group names [3m]
  * Refactor: Wildfire string payload parsing [5m]
  * Enhancement: getInstance() for FirePHP::to("plugin") [37m]
  * Change: Remove 'container' when registering plugins [48m]
  * Enhancement: Throw error when registering a plugin more than once during a request [15m]
  * Enhancement: Added ->notrim()-> and string.trim.length & string.trim.newlines options
  * Enhancement: Added ->expand()-> for all messages
  * Enhancement: New encoder.maxStringLength option [30m]
  * Bugfix: Set FirePHP version dynamically for payload relay test (so upgrade message does not show) [2m]
  * Enhancement: CLI cupport

2010-12-03 - Release Version: 0.0.0master1012031707

  * Enhancement: Ignore comments after // in authkeys in credentials.json [10m]
  * Enhancement: Listener registration for payload [1h30m]
  * Enhancement: Relaying of payloads [1h40m]
  * Bugfix: Set FIREPHP_ACTIVATED constant to FALSE if not enabled [5m]

2010-12-02 - Release Version: 0.0.0master1012021019

  * Bugfix: Missing $ for variable causing E_NOTICE [2m]
  * Bugfix: Notice: Undefined index: Wildfire/Channel.php on line 224 [2m]
  * Bugfix: Fatal error when using FirePHP::plugin() with no client on PHP < 5.3 [2m]
  * Enhancement: Insight-based page-top plugins

2010-11-12 - Release Version: 0.0.0master1011120949

  * Enhancement: Support $console->group('<name>', '<title>')->log('within group') [15m]
  * Bugfix: Fix $console->label('<label>')->group('<name>', '<title>') and other fixes [8m]
  * Enhancement: Config option to set path of credentials.json file [30m]
  * Bugfix: Inclusive merging of credentials.json files [20m]
  * Enhancement: Added FirePHP::plugin("firephp")->logVersion() [4m]
  * Enhancement: Added FB::setLogToInsightConsole() [10m]
  * Enhancement: FirePHP::plugin("firephp")->declareP() & p() [17m]
  * Bugfix: Only send one triggerInspect message if multiple triggered [2m]

2010-11-09 - Release Version: 0.0.0master1011090942

  * Enhancement: $console->options(array('file' => <str>, 'line' => <int>))->... [20m]
  * Enhancement: $console->option('encoder.trace.offsetAdjustment', <int>)->... [15m]
  * Enhancement: $console->option('<name>') and $console->options() to get current options [10m]
  * Bugfix: Remove 'new server library' message in console when using FirePHP/fb.php [24m]
  * Enhancement: Use insight encoder and direct messages to page context if detected [20m]
  * Enhancement: Throw exception when old FirePHP class is loaded from include path [5m]
  * Bugfix: Mixed named and context based groups [20m]
  * Bugfix: Write errors to error log (when trapping via engine plugin) if applicable [40m]
  * Enhancement: Write exceptions to error log (when trapping via engine plugin) if applicable [6m]

2010-10-25 - Release Version: 0.0.0master1010251614

  * Docs: Log to page or request context based on drop-down
  * Enhancement: Default request console to 'Console' tab if not specified [5m]
  * Bugfix: Wildfire protocol parsing if protocol header is last
  * Testing: PHP 5.1, 5.2 & 5.3 on siteground.com [2h10m]
  * Bugfix: File sorting in TestRunner [9m]
  * Enhancement: Update quickstart examples to log to Firebug Console [17m]
  * Bugfix: Use Zend_Json when json_* not available [30m]

2010-10-20 - Release Version: 0.0.0master1010201329

  * Bugfix: Split depthNoLimit into depthNoLimit and lengthNoLimit [10m]
  * Enhancement: Set options via insight API (->options()-> & ->options()->) and tests [42m]
  * Enhancement: Added encoder.trace.maxLength option [23m]
  * Enhancement: Exposed encoder.exception.traceMaxLength option [12m]
  * Enhancement: Support -1 for encoder.max*Length options [9m]
  * Enhancement: Support -1 for encoder.max*Depth options [3m]
  * Bugfix: Fatal error if there is an initialization error [5m]

2010-10-16 - Release Version: 0.0.0master1010160926

  * Enhancement: Discard duplicate errors and trim backtraces for certain errors in FirePHP Engine plugin
  * Enhancement: Upgrade message when using FirePHP Extension
  * Bugfix: Do not initialize insight when using FirePHPCore/fb.php [10m]
  * Enhancement: Provide procedural API via FirePHP/fb.php [5m]
  * Docs: New upgrade page at http://upgrade.firephp.org/ [8h, +misc changes]
  * Bugfix: FirePHP constants when deactivated
  * Enhancement: Added Zend Framework example (shows if ZF is found)
  * Bugfix: Use mb_detect_encoding() if available to check encoding of string objects
  * Enhancement: Added Error Reporting levels to FirePHP_Plugin_FirePHP::recordEnvironment [37m]
  * Bugfix: Use 'instanceof' instead of is_a() [4m]
  * Bugfix: Use mb_detect_encoding() if available for is_utf8() [3m]
  * Enhancement: Backwards compatibility for dump()
  * Enhancement: Added support for $console->group('<Name>', '<Title>')->open();

2010-10-01 - Release Version: 0.0.0master1010012104

  * Enhancement: More detailed json parsing error messages [20m]
  * Enhancement: Direct user to validate json files at http://www.jsonlint.com/ if parsing fails [8m]

2010-09-29 - Release Version: 0.0.0master1009291749

  * Enhancement: Implement FIREPHP_ACTIVATED constant to force-deactivate FirePHP or indicate if activated based on Init.php [10m]
  * Enhancement: FirePHPCore compatibility test pages
  * Enhancement: Log to firebug console for ::to('page') target
  * Bugfix: Some of these tests don't work properly: http://pastebin.com/ZbYt0pwK [1h]

2010-08-29 - Release Version: 0.0.0master1008291629

  * Bugfix: Throw error (instead of silently failing) if no IP set
  * Bugfix: Throw error if "*" is used and not the only authekey or IP
  * Enhancement: Re-use FirePHP object when calling class when not enabled
  * Bugfix: Replaced $_SERVER['SERVER_NAME'] with $_SERVER['HTTP_HOST']
  * Bugfix: Always enable output buffering with ob_start() to disable flush() calls in code
  * Bugfix: Handle ports properly for installation ID
  * Enhancement: Added nolimit() to console API and support in default encoder
  * Enhancement: More comprehensive recordEnvironment() for FirePHP plugin
  * Bugfix: Suppress error logging for FirePHP engine plugin if @ used
  * Bugfix: Avoid globals pollution during initialization

2010-08-20 - Release Version: 0.0.0master1008201514

  * Enhancement: Added recordEnvironment() to FirePHP engine
  * Bugfix: Added INSIGHT_PATHS constant for minimal install method
  * Enhancement: Added is() to console API
  * Enhancement: Added FeedCache example

2010-08-19 - Release Version: 0.0.0master1008191622

  * Enhancement: Minimal install method
  * Enhancement: Added FirePHP engine
  * Enhancement: Added trapProblems() to FirePHP engine

2010-08-03 - Release Version: 0.0.0master1008031622

  * Enhancement: Show payload in tests
  * Bugfix: Header case when matching
  * Optimization: Minimal bootstrap with additional loading of files only if needed
  * Bugfix: Use client key when persisting conditional logging state for request

2010-07-28 - Release Version: 0.0.0master1007282031

  * Enhancement: Implemented selective logging API via $console->on()
  * Change: Some internal refactoring and various changes
  * Bugfix: Don't die if json_last_error() is missing (applicable in some environments)
  * Bugfix: If getallheaders() is missing (applicable in some environments) get request headers from $_SERVER
  * Bugfix: Don't use __DIR__ as it is missing in some environments

2010-07-27 - Release Version: 0.0.0master1007271007

  * Bugfix: Cache path creation

2010-07-26 - Release Version: 0.0.0master1007261803

  * Bugfix: PINF-based cache path verification

2010-07-26 - Release Version: 0.0.0master1007261732

  * Change: PHP version check: 5.1+
  * Enhancement: More advanced automatic cache path detection
  * Enhancement: Added cache.path config option
  * Enhancement: Improved error handling
  * Bugfix: Multiple protocol headers
  * Enhancement: Redirect traditional API calls to insight via setLogToInsightConsole()

2010-07-23 - Release Version: 0.0.0master1007231623

  * Enhancement: Initial implementation for $console->on()
  * Bugfix: Compensate for magic_quotes_gpc when applicable

2010-07-22 - Release Version: 0.0.0master1007221829

  * Bugfix: Enable output buffering if ob_get_level()<=1
  * Added redirect test for traditional and insight API

2010-07-17 - Release Version: 0.0.0master1007171039

  * Bugfix: Append libs to include path when calling FirePHP/Init.php

2010-07-16 - Release Version: 0.0.0master1007161350

  * Enhancement: Support $console->group()->open() (i.e. without specifying group name.)
  * Enhancement: Added INSIGHT_DEBUG constant and debug messages
  * Enhancement: Autoflush after initial batch flush
  * Enhancement: Added maxArrayLength to insight encoder
  * Enhancement: Added maxObjectLength to insight encoder
  * Enhancement: Added support for insight encoder options in package.json
  * Enhancement: Send server library version to client

2010-06-21 - Release Version: 0.0.0master1006211545

  * Public BETA Preview
