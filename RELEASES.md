# Release Notes

## v1.3.4 (16 December 2016)
* Fixed a further bug in which a has many through relationship of the form A->B->C needlessly required the relationship C->B to be defined [#4](https://github.com/zamzar/php-activerecord/issues/4)

## v1.3.3 (16 December 2016)
* Fixed a bug in which a has many through relationship of the form A->B->C needlessly required the relationship C->B to be defined [#4](https://github.com/zamzar/php-activerecord/issues/4)

## v1.3.2 (16 December 2016)
* Fixed a bug in MySQL date time handling [upstream #412](https://github.com/jpfuentes2/php-activerecord/issues/412)
* Adds docker configuration to ease testing

## v1.3.1 (1 December 2016)
* Fixed a bug in which PDO exceptions thrown when starting a transactions would not be reported correctly [#3](https://github.com/zamzar/php-activerecord/issues/3)

## v1.3.0 (31 October 2016)
* Adds PHP 7 compatibility

## v1.2.0 (30 September 2016)
* First release of Zamzar fork of `php-activerecord/php-activerecord`
* Added a simple, file-based implementation of PHP AR cache for installs without memcached [#2](https://github.com/zamzar/php-activerecord/issues/2)
* Fixed a bug in which foreign keys would not be set when using `create_association` [#1](https://github.com/zamzar/php-activerecord/issues/1)
