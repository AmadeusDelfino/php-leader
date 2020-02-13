<?php


namespace ADelf\LeaderServer\Contracts\Foundation;


interface AppConfiguration
{
    public function get($key, $default = null);

    public function set($key, $value): self;
}