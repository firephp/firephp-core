
DONE:

  * Enhancement: Implemented selective logging API via $console->on()

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
