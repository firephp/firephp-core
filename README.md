[![CircleCI](https://circleci.com/gh/firephp/firephp-core.svg?style=svg)](https://circleci.com/gh/firephp/firephp-core)

FirePHPCore
===========

The FirePHP server library for PHP reference implementation compatible with the latest [FirePHP Devtools Extension](https://github.com/firephp/firephp-for-browser-devtools).

> FirePHP is a logging system that can display PHP variables in a browser as an application is navigated. All communication happens via HTTP headers which means the logging data will not interfere with the normal functioning of the application.


Install
-------

[Release history & known issues](https://github.com/firephp/firephp-core/wiki)

### Published

[packagist.org: firephp/firephp-core](https://packagist.org/packages/firephp/firephp-core)

    composer require firephp/firephp-core

### Source

Requirements:

  * [php](https://www.php.net/)
  * [composer](https://getcomposer.org/)
  * [npm](https://www.npmjs.com/get-npm)

Install dependencies:

    composer install

Run tests:

    composer test

Test driven development:

    # npm install -g nodemon
    nodemon

Release:

  1. Update `CHANGELOG.md`
  2. Git tag repository & push


API
---

*For API see `tests/` for now.*


Provenance
==========

Licensed under the [MIT License](https://opensource.org/licenses/mit-license) by [Christoph Dorn](http://christophdorn.com) since 2007.

```
Copyright (c) 2007+ Christoph Dorn

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
```

> Well-crafted Contributions are Welcome.

**INTENDED USE:** The *Logic and Code contained within* forms a **Developer Tool** and is intended to operate as part of a *Web Software Development Toolchain* on which a *Production System* operates indirectly. It is **NOT INTENDED FOR USE IN HIGH-LOAD ENVIRONMENTS** as there is *little focus on Runtime Optimization* in order to *maximize API Utility, Compatibility and Flexibility*.

If you *need more* than what is contained within, study the Code, understand the Logic, and build your *Own Implementation* that is *API Compatible*. Share it with others who follow the same *Logic* and *API Contract* specified within. This Community of Users will likely want to use Your Work in their own *Software Development Toolchains*.
