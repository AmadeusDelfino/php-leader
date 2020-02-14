<?php


namespace ADelf\LeaderServer\Log;


use ADelf\LeaderServer\Contracts\Notification\RequestLog as IRequestLogAlias;

class RequestLog implements IRequestLogAlias
{
    public function warning($message): void
    {
        $string = $this->getPrefixLog('WARNING') . $message;
        echo $string;
    }

    public function info($message): void
    {
        $string = $this->getPrefixLog('INFO') . $message;
        echo $string;
    }

    public function error($message): void
    {
        $string = $this->getPrefixLog('ERROR') . $message;
        echo $string;
    }

    protected function getPrefixLog($type): string
    {
        return '[' . date('Y') . '-' . date('m') . '-' . date('d') . '][' . $type . '] ';
    }
}