<?php


namespace ADelf\LeaderServer\Exceptions;


class RouteNotFoundException extends \Exception
{
    protected $code = 404;
}