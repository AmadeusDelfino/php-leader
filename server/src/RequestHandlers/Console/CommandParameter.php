<?php


namespace ADelf\LeaderServer\RequestHandlers\Console;


class CommandParameter
{
    protected $name = '';
    protected $required = false;
    protected $value;
    protected $description = '';

    public function __construct(string $name, $value, $required = false, $description = '')
    {
        $this->name = $name;
        $this->value = $value;
        $this->required = $required;
        $this->description = $description;
    }

    public function setValue($value): self
    {
        $this->value = $value;

        return $this;
    }

    public function validate(): bool
    {
        if($this->required && ($this->value === null || empty($this->value))) {
            throw new \InvalidArgumentException('The value cannot be empty');
        }
    }

    public function name(): string
    {
        return $this->name;
    }

    public function value()
    {
        return $this->value;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function required(): bool
    {
        return $this->required;
    }

}