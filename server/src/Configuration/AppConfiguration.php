<?php


namespace ADelf\LeaderServer\Configuration;


use Adelf\Config\Config;
use ADelf\LeaderServer\Contracts\Foundation\AppConfiguration as IAppConfiguration;

class AppConfiguration implements IAppConfiguration
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

    public function set($key, $value): IAppConfiguration
    {
        $this->configBag->set($key, $value);

        return $this;
    }
}