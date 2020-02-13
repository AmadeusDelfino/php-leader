<?php


namespace ADelf\LeaderServer\Contracts\Foundation;


interface App
{
    public function start(): int;

    /**
     * Get the version number of the application.
     *
     * @return string
     */
    public function version(): string;

    /**
     * Get the path to the application configuration files.
     *
     * @param  string  $path Optionally, a path to append to the config path
     * @return string
     */
    public function configPath($path = null): string;

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
}