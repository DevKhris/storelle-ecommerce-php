<?php

/**
 * Class Request for request management
 *
 * @package RubyNight\App\Core;
 *
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */

namespace App\Core;

class Request
{
    public $params;
    public $body;
    public $method;
    public $contentType;
    /**
     * Constructor
     */
    function __construct(array $parameters)
    {
        $this->params = $this->getParams();
        $this->body = $this->getBody();
        $this->method = $this->getMethod();
        $this->contentType = $this->getType();
    }


    /**
     * Get the relative path
     *
     * @return string path
     */
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $pos = strpos($path, '?');
        if (!$pos) {
            return $path;
        }
        $path = substr($path, 0, $pos);

        return $path;
    }

    /**
     * Get method from server
     * 
     * @return string method
     */
    public function getMethod()
    {
        $method = strtolower($_SERVER['REQUEST_METHOD'] ?? 'GET');

        return $method;
    }

    public function onGet()
    {
        return $this->getMethod() === 'GET';
    }

    public function onPost()
    {
        return $this->getMethod() === 'POST';
    }

    /**
     * Get contentType from server
     *
     * @return void
     */
    public function getType(): string
    {
        return (!empty($_SERVER['CONTENT_TYPE'])) ? trim($_SERVER['CONTENT_TYPE']) : 'application/html';

    }

    /**
     * Get body function
     *
     * @return array
     */
    public function getBody(): array
    {
        $body = [];
        if ($this->getMethod() == 'POST') {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(
                    INPUT_POST,
                    $key,
                    FILTER_SANITIZE_SPECIAL_CHARS
                );
            }
        }

        if ($this->getMethod() == 'GET') {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(
                    INPUT_GET,
                    $key,
                    FILTER_SANITIZE_SPECIAL_CHARS
                );
            }
        }
        return $body;
    }

    /**
     * Get parameters from request
     *
     * @return array
     */
    public function getParams(): array
    {
        foreach ($_REQUEST as $key => $value) {
            return [$key => $value];
        }

        return [];
    }
}