<?php

use ADelf\LeaderServer\App;
use React\EventLoop\Factory;

$app = App::instance();
$app->start();

$loop = $app->reactLoop();
