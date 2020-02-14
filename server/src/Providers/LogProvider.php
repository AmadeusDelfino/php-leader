<?php


namespace ADelf\LeaderServer\Providers;


use ADelf\LeaderServer\Contracts\Foundation\Provider;
use ADelf\LeaderServer\Log\NotifyLog;
use ADelf\LeaderServer\Log\RequestLog;
use Pimple\Container;

class LogProvider implements Provider
{
    /**
     * @inheritDoc
     */
    public function register(Container $pimple)
    {
        $pimple['notifyLog'] = new NotifyLog();
        $pimple['requestLog'] = new RequestLog();
    }
}