<?php


namespace ADelf\LeaderServer\Services;


use ADelf\LeaderServer\Exceptions\WorkerNotificationFailedException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class WorkerCommunicationService
{
    /**
     * @param string $ip
     * @param int $port
     * @param string $body
     * @throws WorkerNotificationFailedException
     */
    public function notify(string $ip, int $port, string $body)
    {
        $client = new Client();
        $request = new Request('POST', $ip . $port, [], $body);
        $response = $client->send($request);
        if($response->getStatusCode() !== 200) {
            throw new WorkerNotificationFailedException();
        }
    }
}