<?php
/**
 * Created by PhpStorm.
 * User: urashav
 * Date: 2019-03-04
 * Time: 13:01
 */

namespace Core;


use Controllers\MainController;

class Application
{
    public function __construct()
    {
    }

    // Запускаем приложение

    /**
     *
     */
    public function run()
    {
        $this->loader();
        $this->router();
    }


    // автолоадер

    /**
     *
     */
    public function loader(): void
    {
        require_once 'autoloader.php';
    }

    /**
     *
     *
     * @return string
     */

    //Возвращает URI, без крайних слэшей, в нижнем регистре.
    public function getURI(): string
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }


    /**
     * Собственно роутер
     */
    public function router(): void
    {
        switch ($this->getURI()) {
            case '':
                $controller = new MainController();
                $controller->index();
                break;
            case 'ajax':
                $controller = new MainController();
                $controller->ajax();
                break;
            default:
                $this->error404();
        }
    }

    public function error404(): void
    {
        header('HTTP/1.1 404 Not Found');
        include BASE_DIR . '/public/errors/404.html';
    }
}
