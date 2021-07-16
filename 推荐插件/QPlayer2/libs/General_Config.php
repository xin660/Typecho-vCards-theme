<?php

namespace QPlayer;

class General_Config
{
    private $config;

    public function __construct($config)
    {
        $this->config = $config->general;
    }

    public function getBool($key)
    {
        return in_array($key, $this->config);
    }

    public function getBoolString($key)
    {
        return $this->getBool($key) ? 'true' : 'false';
    }
}