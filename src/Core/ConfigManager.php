<?php

namespace App\Core;

class ConfigManager
{
    /**
     * Configuration array
     */
    private array $config = [];

    /**
     * Constructor instance for config.
     */
    public function __construct(string $path)
    {
        $config = [];

        foreach(glob($path) as $file) {
            $fileName = pathInfo($file)['filename'];
            $this->set($fileName, require_once $file);
        }
    }

    public function get(string $key): mixed
    {
        return $this->config[$key];
    }


    public function set(string $key, mixed $value): void
    {
        $this->config[$key] = $value;
    }
}