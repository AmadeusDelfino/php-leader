<?php

require 'vendor/autoload.php';

$app = new \ADelf\LeaderServer\App();
$app->start();
/**
 * @var $workersController \ADelf\LeaderServer\Contracts\Workers\WorkersController
 */
$workersController = $app->container()['workersController'];
$worker = new \ADelf\LeaderServer\Workers\Worker('127.0.0.1', 14589);
$workersController->addWorker($worker);
$message = new \ADelf\LeaderServer\WorkerNotify\NotifyMessage(['olá' => 'mundo']);
$broadcast = new \ADelf\LeaderServer\WorkerNotify\Broadcast($message);
$broadcastResponse = $workersController->broadcast($broadcast);
var_dump($workersController, $broadcastResponse);
