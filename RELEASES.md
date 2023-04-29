# Release Notes

## v1.7.0 (29 April 2023)
* Adds support for PHP 8.0, 8.1 and 8.2
* Drops support for PHP 7.3

## v1.6.0 (1 January 2021)
* Adds support for PHP 7.4
* Drops support for PHP 7.2

## v1.5.0 (20 October 2018)
* Adds support for PHP 7.2 [#9](https://github.com/zamzar/php-activerecord/issues/9)

## v1.4.6 (26 July 2018)
* Fixed a bug that prevent reflection on dynamic properties for relationships [#8](https://github.com/zamzar/php-activerecord/issues/8)

## v1.4.5 (22 March 2018)
* Made it possible to close a DB connection by calling `Table::drop_connection` [#6](https://github.com/zamzar/php-activerecord/pull/6)

## v1.4.4 (11 January 2017)
* Fixed a bug that prevented all records from being loaded when eager loading a has many through relationship of the form A->B->C when there was no relationship C->B

## v1.3.5 (11 January 2017)
* Fixed a bug that prevented all records from being loaded when eager loading a has many through relationship of the form A->B->C when there was no relationship C->B

## v1.4.3 (16 December 2016)
* Fixed a further bug in which a has many through relationship of the form A->B->C needlessly required the relationship C->B to be defined [#4](https://github.com/zamzar/php-activerecord/issues/4)

## v1.3.4 (16 December 2016)
* Fixed a further bug in which a has many through relationship of the form A->B->C needlessly required the relationship C->B to be defined [#4](https://github.com/zamzar/php-activerecord/issues/4)

## v1.4.2 (16 December 2016)
* Fixed a bug in which a has many through relationship of the form A->B->C needlessly required the relationship C->B to be defined [#4](https://github.com/zamzar/php-activerecord/issues/4)

## v1.3.3 (16 December 2016)
* Fixed a bug in which a has many through relationship of the form A->B->C needlessly required the relationship C->B to be defined [#4](https://github.com/zamzar/php-activerecord/issues/4)

## v1.4.1 (16 December 2016)
* Fixed a bug in MySQL date time handling [upstream #412](https://github.com/jpfuentes2/php-activerecord/issues/412)
* Adds docker configuration to ease testing

## v1.3.2 (16 December 2016)
* Fixed a bug in MySQL date time handling [upstream #412](https://github.com/jpfuentes2/php-activerecord/issues/412)
* Adds docker configuration to ease testing

## v1.4.0 (12 December 2016)
* Removes PHP ActiveRecord's autoloader, as Composer usage is now widespread [#5](https://github.com/zamzar/php-activerecord/issues/5)

## v1.3.1 (1 December 2016)
* Fixed a bug in which PDO exceptions thrown when starting a transactions would not be reported correctly [#3](https://github.com/zamzar/php-activerecord/issues/3)

## v1.3.0 (31 October 2016)
* Adds PHP 7 compatibility

## v1.2.0 (30 September 2016)
* First release of Zamzar fork of `php-activerecord/php-activerecord`
* Added a simple, file-based implementation of PHP AR cache for installs without memcached [#2](https://github.com/zamzar/php-activerecord/issues/2)
* Fixed a bug in which foreign keys would not be set when using `create_association` [#1](https://github.com/zamzar/php-activerecord/issues/1)
