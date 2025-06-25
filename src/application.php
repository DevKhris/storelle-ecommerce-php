<?php

namespace App;

/**
 * Application Class
 *
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 *
 */
class Application
{
    public static string $path;

    public static Application $app;

    /**
     * Contructor function.
     *
     * @param array $config application config
     */
    public function __construct(array $config)
    {
        self::$app = $this;
        self::$path = $config['path'];
    }
}