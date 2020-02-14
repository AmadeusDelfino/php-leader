<?php


namespace ADelf\LeaderServer\Exceptions;


class NullMessageException extends \Exception
{
    protected $code = 101;
    protected $message = 'Message is null';
}