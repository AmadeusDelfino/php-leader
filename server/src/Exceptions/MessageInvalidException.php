<?php


namespace ADelf\LeaderServer\Exceptions;


class MessageInvalidException extends \Exception
{
    protected $code = 101;
    protected $message = 'The message is in an incorrect format';
}