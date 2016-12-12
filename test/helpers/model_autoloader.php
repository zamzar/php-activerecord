<?php
/*
 * We currently run our own autoloader because our model files cannot be readily loaded by Composer.
 * Eventually, we will want our models to be loaded via Composer and will achieve this by "moving"
 * them to the namespaces corresponding to their locations on disk.
 *
 * However, changing the namespace of all our models is a large and risky refactoring. Rather than
 * perform this refactoring all at once, this autoloader allows us to refactor models one at a time.
 */

// Register our autoloader to run after Composer's by using prepend = false
spl_autoload_register("phparTestAutoloaderTemporary", true, false);

function phparTestAutoloaderTemporary($className) {
  // Look in these directories for the class that is to be autoloader
  $root = __DIR__ . "/..";
  $modelDirectories = ["models"];

	// Replace namespace seperators with directory separators
	$modelPath = str_replace("\\", "/", $className);

	foreach ($modelDirectories as $modelDirectory) {
		if (file_exists("$root/$modelDirectory/$modelPath.php")) {
			require_once "$root/$modelDirectory/$modelPath.php";
			break;
		}
	}
}
