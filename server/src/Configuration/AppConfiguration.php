<?php


namespace ADelf\LeaderServer\Configuration;


use Adelf\Config\Config;

class AppConfiguration implements \ADelf\LeaderServer\Contracts\Foundation\AppConfiguration
{
    /**
     * @var Config
     */
    protected $configBag;

    public function __construct()
    {
        $this->configBag = Config::instance();
    }

    public function get($key, $default = null)
    {
        return $this->configBag->get($key, $default);
    }

    public function set($key, $value): \ADelf\LeaderServer\Contracts\Foundation\AppConfiguration
    {
        $this->configBag->set($key, $value);

        return $this;
    }
}