<?php


namespace ADelf\LeaderServer\RequestHandlers\Tcp;


use ADelf\LeaderServer\Workers\Worker;

class RegisterWorkerHandler extends TcpHandler
{
    protected $paramsValidate = [
        'manifest',
    ];

    public function __invoke()
    {
        $worker = new Worker($this->params['connection']);
        $id = works()->addWorker($worker);

        return [
            'action' => 'post_register',
            'id' => $id,
        ];
    }
}