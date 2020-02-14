<?php


namespace ADelf\LeaderServer\Exceptions;


class WorkerNotificationFailedException extends \Exception
{
    protected $code = 500;
    protected $message = 'Could not notify worker';
}