<?php


namespace ADelf\LeaderServer\RequestHandlers\Console;


use ADelf\LeaderServer\Contracts\Router\ConsoleRequest;
use Clue\React\Stdio\Stdio;

abstract class Command implements ConsoleRequest
{
    protected $description = '';
    protected $args = [];
    protected $paramsClasses = [];

    public function __construct()
    {
        $this->initArgumentClasses();
    }

    public function handler(array $params, Stdio $stdio): void
    {
        $this->fetchArgs($params);
        $this->execute($stdio);
    }

    abstract protected function execute(Stdio $stdio): void;

    /**
     * @param string|null $name
     * @return array|CommandArgument
     */
    public function args(string $name = null)
    {
        if($name === null) {
            return $this->paramsClasses;
        }

        if(!isset($this->paramsClasses[$name])) {
            throw new \InvalidArgumentException('Arg ' . $name . ' not defined.');
        }

        return $this->paramsClasses[$name];
    }


    protected function fetchArgs(array $params): void
    {
        foreach ($params as $param => $value) {
            if (!isset($this->paramsClasses[$param])) {
                throw new \InvalidArgumentException('Param ' . $param . ' not exists.');
            }
            /**
             * @var $class CommandArgument
             */
            $class = $this->paramsClasses[$param];
            $class->setValue($value);
            $this->paramsClasses[$param] = $class;
        }
    }

    protected function initArgumentClasses(): void
    {
        foreach ($this->args as $name => $config) {
            $this->paramsClasses[$name] = new CommandArgument(
                $name,
                '',
                $config['required'] ?? false,
                $config['description'] ?? '',
                $config['default'] ?? null
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