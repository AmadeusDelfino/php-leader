<?php


namespace ADelf\LeaderServer\Router;


use ADelf\LeaderServer\Contracts\Foundation\ConsoleRouter;
use ADelf\LeaderServer\Exceptions\RouteNotFoundException;
use Clue\React\Stdio\Stdio;

class ConsoleRouterHandler implements ConsoleRouter
{
    public function handler(string $command, Stdio $stdio): void
    {
        $command = $this->normalizeCommand($command);
        $command = $this->splitParams($command);
        try {
            $class = $this->match($command['command']);
        } catch (RouteNotFoundException $e) {
            $stdio->write($e->getMessage());

            return;
        }
        $stdio->addHistory($command);
        (new $class())->handler($command['params'], $stdio);
    }

    protected function splitParams($command): array
    {
        $split = explode(' ', $command);

        return [
            'command' => $split[0],
            'params' => $this->normalizeParams(array_slice($split, 1)),
        ];
    }

    protected function normalizeParams($params): array
    {
        $normalized = [];
        foreach($params as $param) {
            $split = explode('=', $param);
            $normalized[str_replace('-', '', $split[0])] = $split[1];
        }

        return $normalized;
    }

    protected function normalizeCommand($command): string
    {
        return rtrim($command, "\r\n");
    }

    /**
     * @param $command
     * @return string
     * @throws RouteNotFoundException
     */
    protected function match($command): string
    {
        $routes = app()->config()->get('routes.console');
        if(!array_key_exists($command, $routes)) {
            throw new RouteNotFoundException('command ' . $command . ' not found.');
        }

        return $routes[$command];
    }
}