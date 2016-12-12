<?php
if (!defined('PHP_VERSION_ID') || PHP_VERSION_ID < 50300)
	die('PHP ActiveRecord requires PHP 5.3 or higher');

define('PHP_ACTIVERECORD_VERSION_ID','1.0');

require __DIR__.'/lib/Singleton.php';
require __DIR__.'/lib/Config.php';
require __DIR__.'/lib/Utils.php';
require __DIR__.'/lib/DateTime.php';
require __DIR__.'/lib/Model.php';
require __DIR__.'/lib/Table.php';
require __DIR__.'/lib/ConnectionManager.php';
require __DIR__.'/lib/Connection.php';
require __DIR__.'/lib/SQLBuilder.php';
require __DIR__.'/lib/Reflections.php';
require __DIR__.'/lib/Inflector.php';
require __DIR__.'/lib/CallBack.php';
require __DIR__.'/lib/Exceptions.php';
require __DIR__.'/lib/Cache.php';
