<?php


namespace ADelf\LeaderServer\RequestHandlers\Tcp;


class PingHandler
{
    public function __invoke($params)
    {
        return 'pong';
    }
}