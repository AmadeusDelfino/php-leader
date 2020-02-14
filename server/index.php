<?php

use ADelf\LeaderServer\App;
use ADelf\LeaderServer\Contracts\Workers\WorkersController;
use ADelf\LeaderServer\WorkerNotify\Broadcast;
use ADelf\LeaderServer\WorkerNotify\NotifyMessage;
use ADelf\LeaderServer\Workers\Worker;

require 'vendor/autoload.php';

$app = App::instance();
$app->start();
/**
 * @var $workersController WorkersController
 */
$workersController = $app->container()['workersController'];
$worker = new Worker('127.0.0.1', 14589);
$workersController->addWorker($worker);
$message = new NotifyMessage(['olá' => 'mundo']);
$broadcast = new Broadcast($message);
$broadcastResponse = $workersController->broadcast($broadcast);
$app->notifyLog()->error('Teste');
//var_dump($app);
