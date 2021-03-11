<?php

namespace App\Core;

use App\Application;
use DebugBar\StandardDebugBar;

class View
{
    public function __construct()
    {
    }
    /**
     * Render view function
     *
     * @param string $view view to render
     *
     * @return string
     */
    public function view($view, $params = [])
    {
        $content = $this->display();
        if (!empty($params)) {
            $view = $this->render($view, $params);
        } else {
            $view = $this->render($view);
        }
        echo str_replace('{{ display }}', $view, $content);
    }

    protected function display()
    {
        ob_start();
        include_once Application::$path . "/resources/views/app.php";
        return ob_get_clean();
    }

    /**
     * Render function
     *
     * @param string $view   view
     * @param array  $params parameters for view
     *
     * @return object
     */
    protected function render($view, $params = [])
    {
        $view = str_replace('.', DIRECTORY_SEPARATOR, $view);

        ob_start();
        if (!empty($params)) {
            extract($params);
            foreach ($params as $key => $value) {
                $params[$key] = $value;
            }
        }
        include Application::$path . "/resources/views/" . "$view.php";
        return ob_get_clean();
    }

    protected function call($callback, $params = null)
    {
        call_user_func($callback, $params);
    }
}