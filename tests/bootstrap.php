<?php
/** This file adds a PSR 4 compatible helper path to the autoloader.
 */

function getAutoloader () {
	return include(__DIR__ . '/../vendor/autoload.php');
}

$autoloader = getAutoloader();
$autoloader->addPsr4('TestUtils\\', __DIR__ . '/lib');

return $autoloader;
