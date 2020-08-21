<?php


namespace ADelf\LeaderServer\RequestHandlers\Tcp;


use ADelf\LeaderServer\Exceptions\MessageInvalidException;

abstract class TcpHandler
{
    protected $params;
    protected $paramsValidate = [
        'action',
        'payload'
    ];

    public function __construct($params)
    {
        $this->params = json_decode($params);
        if($this->params === null) {
            throw new MessageInvalidException();
        }
        $this->validateParams();
    }

    protected function validateParams()
    {
        foreach ($this->paramsValidate as $param) {
            if(!isset($this->params->{$param})) {
                throw new \InvalidArgumentException('Arg ' . $param . ' is not set in request');
            }
        }
    }
}