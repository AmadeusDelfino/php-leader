<?php


namespace ADelf\LeaderServer\Router;


use ADelf\LeaderServer\Exceptions\RouteNotFoundException;
use ADelf\LeaderServer\Exceptions\TcpRouteIncorrectFormatException;

class TcpRouterHandler
{
    protected $routes = [];

    public function handler($data)
    {
        $this->defineRoutes();
        $data = $this->normalizeRequest($data);
        $actionHandler = $this->match($data->action);

        return $this->makeResponse($data->action, $this->handleRequest($actionHandler, $data->params));
    }

    protected function makeResponse($action, $data)
    {
        return json_encode([
            'requested_action' => $action,
            'response' => $data,
        ]);
    }

    protected function normalizeRequest($data)
    {
        $data = json_decode($data);
        if(!isset($data->action) || !isset($data->params)) {
            throw new TcpRouteIncorrectFormatException('Action or params not set in tcp request.');
        }

        return $data;
    }

    protected function match($action)
    {
        if(!isset($this->routes[$action])) {
            throw new RouteNotFoundException('Action ' . $action . ' not found.');
        }

        return $this->routes[$action];
    }

    protected function handleRequest($actionHandler, $params)
    {
        if(!class_exists($actionHandler)) {
            throw new RouteNotFoundException('Action ' . $actionHandler . ' not found');
        }

        return (new $actionHandler)($params);
    }

    protected function defineRoutes(): void
    {
        $this->routes = app()->config()->get('routes.tcp', []);
    }
}