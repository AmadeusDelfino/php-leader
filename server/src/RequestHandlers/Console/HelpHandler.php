<?php


namespace ADelf\LeaderServer\RequestHandlers\Console;


use ADelf\LeaderServer\Exceptions\RouteNotFoundException;
use Clue\React\Stdio\Stdio;

class HelpHandler extends Command
{
    protected $description = 'list all available commands';
    protected $args = [
        'teste' => [
            'required' => true,
            'description' => 'bla bla bla'
        ],
        'teste_1' => [
            'required' => false,
            'description' => 'bla bla bla 2',
        ],
        'teste_2',
    ];

    protected function buildParamsString(Command $handler): string
    {
        $stringParams = '';
        foreach($handler->parameters() as $parameter) {
            /**
             * @var $parameter CommandArgument
             */
            $required = $parameter->required() ? 'required' : 'not required';
            $stringParams .= '--' . $parameter->name() . '=' . '<' . '(' . $parameter->description() . ' | ' . $required .')' . '> ';

        }

        return $stringParams;
    }

    protected function execute(Stdio $stdio): void
    {
        $stdio->write('Commands: ' . PHP_EOL);
        foreach (config()->get('routes.console') as $command => $class) {
            /**
             * @var $handler Command
             */
            if(!class_exists($class)) {
                throw new RouteNotFoundException('Command ' . $command . ' has a nonexistent handler:' . $class);
            }

            $handler = new $class();
            $stdio->write($command . ' ' .$this->buildParamsString($handler) . PHP_EOL . $handler->description());
            $stdio->write(PHP_EOL . '-----------------------------------------------' . PHP_EOL);
        }
    }
}