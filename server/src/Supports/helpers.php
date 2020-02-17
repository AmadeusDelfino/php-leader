<?php

if(!function_exists('event')) {
    function event(\ADelf\LeaderServer\Contracts\Event\EventFire $event) {
        (new \ADelf\LeaderServer\Services\EventService())->fire($event);
    }
}