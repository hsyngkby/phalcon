<?php namespace Hsyngkby\Support\Traits\Application;

trait ApplicationVariable
{
    protected $variables = '';

    public function getVariables()
    {
        return $this->variables;
    }

    public function getVariable($key, $default = NULL)
    {
        return array_get($this->variables, $key, $default);
    }

    public function setVariables($variables)
    {
        $this->variables = $variables;
    }

    public function setVariable($key, $value)
    {
        array_set($this->variables, $key, $value);
    }

}