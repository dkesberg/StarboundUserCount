<?php
/**
 * @author      Daniel Kesberg <kesberg@ebene3.com>
 * @copyright   (c) 2013, Daniel Kesberg
 */

// require composer
require_once __DIR__ .'/../vendor/autoload.php';

// set application directory
// Define path to application directory
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../app'));

// load config
$config = require APPLICATION_PATH . '/config/app.php';

// init app
$app = new \Slim\Slim(array(
    'debug'             => true,
    'templates.path'    => '../app/templates',
    'log.level'         => \Slim\Log::DEBUG,
    'log.writer'        => new \Slim\LogWriter(APPLICATION_PATH . '/' . $config['paths']['appliation_log'])
));


$app->get('/', function() use ($app) {
    $log = $app->getLog();
    $log->info('test');
    echo "Get out!";
});
$app->run();
