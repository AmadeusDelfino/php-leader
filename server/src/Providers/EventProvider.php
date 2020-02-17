<?php


namespace ADelf\LeaderServer\Providers;


use ADelf\LeaderServer\Contracts\Foundation\Provider;
use ADelf\LeaderServer\EventsFoundation\EventController;
use Pimple\Container;

class EventProvider implements Provider
{
    /**
     * @inheritDoc
     */
    public function register(Container $pimple)
    {
        $pimple['eventController'] = new EventController();
    }
}