<?php


namespace ADelf\LeaderServer\RequestHandlers\Console;


use ADelf\LeaderServer\Contracts\Router\ConsoleRequest;

abstract class Command implements ConsoleRequest
{
    protected $description = '';
    protected $params = [];
    protected $paramsClasses = [];

    public function __construct()
    {
        $this->initParameterClasses();;
    }

    protected function initParameterClasses(): void
    {
        foreach($this->params as $key=>$config) {
            $this->paramsClasses[] = new CommandParameter(
                $key,
                '',
                $config['required'] ?? false,
                $config['description'] ?? ''
            );
        }
    }

    public function description(): string
    {
        return $this->description;
    }

    public function parameters(): array
    {
        return $this->paramsClasses;
    }
}