<?php
/**
 * Entry point of the unit tests.
 * @module test.index
 */

// Load the dependencies.
$rootPath=dirname(__DIR__);
require_once $rootPath.'/vendor/yiisoft/yii/framework/yiit.php';
require_once $rootPath.'/vendor/mustache/mustache/src/Mustache/Autoloader.php';

// Register class loaders.
spl_autoload_unregister([ 'YiiBase','autoload' ]);
require_once $rootPath.'/vendor/phpunit/phpunit-story/PHPUnit/Extensions/Story/Autoload.php';
Mustache_Autoloader::register();
spl_autoload_register([ 'YiiBase','autoload' ]);

// Initialize the test application.
Yii::createWebApplication([
  'aliases'=>[ 'mustache'=>'application' ],
  'basePath'=>$rootPath.'/lib',
  'extensionPath'=>$rootPath.'/vendor'
]);
