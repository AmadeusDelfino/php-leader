<?php
/**
 * @var $loop
 */

use Clue\React\Stdio\Stdio;

$stdio = new Stdio($loop);
$stdio->setPrompt('Input > ');
$stdio->setAutocomplete(function () {
    return array_keys(config()->get('routes.console'));
});
$stdio->on('data', static function ($line) use($stdio) {
    try {
        \app()->container('consoleRouter')->handler($line, $stdio);
    } catch (\Exception $e) {
        $stdio->write('Error: ' . $e->getMessage());
    }
});
