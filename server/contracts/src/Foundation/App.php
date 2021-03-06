<?php


namespace ADelf\LeaderServer\Contracts\Foundation;

use ADelf\LeaderServer\Contracts\Workers\WorkersController;

interface App
{
    public function start(): int;

    /**
     * Get the version number of the application.
     *
     * @return string
     */
    public function version(): string;

    public function container($key = null);

    /**
     * Terminate the application.
     *
     * @return int
     */
    public function terminate(): int;

    /**
     * Register a new provider in application
     *
     * @param Provider $provider
     * @return mixed
     */
    public function registerProvider(Provider $provider);

    public function workersController(): WorkersController;

    public function config(): AppConfiguration;

    public function reactLoop();
}