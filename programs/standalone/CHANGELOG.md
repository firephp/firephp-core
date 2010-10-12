
TODO:

  * Bugfix: Write exceptions to error log (when trapping via engine plugin)

// HIGH

  * Bugfix: Throw error if first message logged to a group is not a simple log message
  * Enhancement: Redirect all $firephp->* calls to FirePHP::to('page') if insight page context detected
  * Bugfix: Do not send page context messages if receiver is not announced
  * Enhancement: Deprecation notice if traditional inclusion method used
  * Enhancement: Support workaround for PHP < 5.3 where __callstatic magic class method not supported
  * Change: Send headers at beginning of script to avoid need for output buffering

DONE:

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
