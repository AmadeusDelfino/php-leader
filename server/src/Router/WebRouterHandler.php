<?php


namespace ADelf\LeaderServer\Router;


use ADelf\LeaderServer\Contracts\Foundation\Router;
use ADelf\LeaderServer\Exceptions\RouteNotFoundException;
use Psr\Http\Message\ServerRequestInterface;
use React\Http\Response;

class WebRouterHandler implements Router
{
    public function handler(ServerRequestInterface $request)
    {
        if ($request->getMethod() !== 'POST') {
            return new Response(
                405,
                ['Content-Type' => 'text/plain'],
                'Use method post'
            );
        }

        return $this->handleRequest($request);
    }

    /**
     * @param ServerRequestInterface $request
     * @return mixed
     * @throws RouteNotFoundException
     */
    protected function handleRequest(ServerRequestInterface $request)
    {
        $uri = $request->getUri()->getPath();
        $routes = app()->config()->get('routes.web');
        $referenceClass = $this->match($routes, $uri);

        return $referenceClass($request);
    }

    public function match($routes, $uri)
    {
        if(!in_array($uri, $routes, true)) {
            throw new RouteNotFoundException('Route ' . $uri . ' not found.');
        }

        return new $routes[$uri]();
    }
}