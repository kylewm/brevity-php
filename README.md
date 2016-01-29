# brevity-php

[![Build Status](https://travis-ci.org/kylewm/brevity-php.svg?branch=master)](https://travis-ci.org/kylewm/brevity-php)

A small utility to count characters, autolink, and shorten posts to an
acceptable tweet-length summary.

This is a port of the Python module of the same name. Please refer to
https://github.com/kylewm/brevity for documentation.

Note that this module depends on the `mb_` string methods to be
available. I get the best results by setting

```php
mb_internal_encoding('UTF-8');
```

somewhere in my project.
