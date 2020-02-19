<?php


namespace ADelf\LeaderServer\Contracts\Router;


use Clue\React\Stdio\Stdio;

interface ConsoleRequest
{
    public function handler(array $params, Stdio $stdio): void;

    public function description(): string;

    public function parameters(): array;
}