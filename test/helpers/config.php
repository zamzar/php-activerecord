<?php

/**
 * In order to run these unit tests, you need to install the required packages using Composer:
 *
 *    $ composer install
 *
 * After that you can run the tests by invoking the local PHPUnit
 *
 * To run all test simply use:
 *
 *    $ vendor/bin/phpunit
 *
 * Or run a single test file by specifying its path:
 *
 *    $ vendor/bin/phpunit test/InflectorTest.php
 *
 **/

use ActiveRecord\Config;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

require_once 'vendor/autoload.php';
require_once __DIR__ .'/model_autoloader.php';

require_once 'SnakeCase_PHPUnit_Framework_TestCase.php';

require_once 'DatabaseTest.php';
require_once 'AdapterTest.php';

require_once __DIR__ . '/../../ActiveRecord.php';

// whether or not to run the slow non-crucial tests
$GLOBALS['slow_tests'] = false;

// whether or not to show warnings when Log or Memcache is missing
$GLOBALS['show_warnings'] = true;

if (getenv('LOG') !== 'false')
	DatabaseTest::$log = true;

ActiveRecord\Config::initialize(function(Config $cfg)
{
	$cfg->set_connections(array(
		'mysql'  => getenv('PHPAR_MYSQL')  ?: 'mysql://test:test@127.0.0.1/test',
		'pgsql'  => getenv('PHPAR_PGSQL')  ?: 'pgsql://test:test@127.0.0.1/test',
		'oci'    => getenv('PHPAR_OCI')    ?: 'oci://test:test@127.0.0.1/dev',
		'sqlite' => getenv('PHPAR_SQLITE') ?: 'sqlite://test.db'));

	$cfg->set_default_connection('mysql');

	for ($i=0; $i<count($GLOBALS['argv']); ++$i)
	{
		if ($GLOBALS['argv'][$i] == '--adapter')
			$cfg->set_default_connection($GLOBALS['argv'][$i+1]);
		elseif ($GLOBALS['argv'][$i] == '--slow-tests')
			$GLOBALS['slow_tests'] = true;
	}

    $logger = new Logger('tests');
    $logger->pushHandler(new StreamHandler(dirname(__FILE__) . '/../log/query.log', Logger::DEBUG));
    $cfg->set_logger($logger);

	if ($GLOBALS['show_warnings']  && !isset($GLOBALS['show_warnings_done']))
	{
		if (!extension_loaded('memcached'))
			echo "(Cache Tests will be skipped, Memcache not found.)\n";
	}

	date_default_timezone_set('UTC');

	$GLOBALS['show_warnings_done'] = true;
});

error_reporting(E_ALL | E_STRICT);

