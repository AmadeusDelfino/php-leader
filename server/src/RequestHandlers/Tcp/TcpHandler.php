<?php


namespace ADelf\LeaderServer\RequestHandlers\Tcp;


use ADelf\LeaderServer\Exceptions\MessageInvalidException;

abstract class TcpHandler
{
    protected $params;
    protected $paramsValidate = [];

    public function __construct($params)
    {
        $this->params = $params;
        if($this->params === null) {
            throw new MessageInvalidException();
        }
        $this->validateParams();
    }

    protected function validateParams()
    {
        foreach ($this->paramsValidate as $param) {
            if(!isset($this->params['data']->{$param})) {
                throw new \InvalidArgumentException('Arg ' . $param . ' is not set in request');
            }
        }
    }
}