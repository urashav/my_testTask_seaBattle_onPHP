<?php
/**
 * Created by PhpStorm.
 * User: urashav
 * Date: 2019-03-05
 * Time: 08:20
 */

namespace Controllers;

abstract class BaseController
{
    // Метод редиректа
    public function redirect($uri)
    {
        header('Location: ' . $uri);
    }
}
