<?php


namespace ADelf\LeaderServer\Contracts\Foundation;


use Clue\React\Stdio\Stdio;

interface ConsoleRouter
{
    public function handler(string $command, Stdio $stdio);
}