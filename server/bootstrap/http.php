<?php
/**
 * @var $loop
 */

use Psr\Http\Message\ServerRequestInterface;
use React\Http\Server;

$server = new Server(static function (ServerRequestInterface $request) {
    try {
        return \app()->container('webRouter')->handler($request);
    } catch (\Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
});
$port = app()->config()->get('app.port');
$socket = new \React\Socket\Server($port, $loop);
$server->listen($socket);

//echo 'Server HTTP listening on: ' . $socket->getAddress() . "\n";
