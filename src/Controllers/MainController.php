<?php
/**
 * Created by PhpStorm.
 * User: urashav
 * Date: 2019-03-05
 * Time: 08:20
 */

namespace Controllers;

use Models\Field;
use Models\Ships\ShipsFactory;

class MainController extends BaseController
{
    public $field;

    // Подключаем представление индекса
    public function index()
    {
        require BASE_DIR . '/src/Views/index.php';
    }

    // Запрос AJAX
    public function ajax()
    {
        // Создаем поле, в параметрах передаем фабрику с кораблями,
        // и вторым параметром массив название корабля =>количество
        $field = new Field(new ShipsFactory(), [
            'SingleDeck' => 4,
            'DoubleDeck' => 3,
            'TripleDeck' => 2,
            'FourDeck' => 1,
        ]);

        try {
            $result = $field->getField();
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }

        // Подключаем представление с кораблями
        require BASE_DIR . '/src/Views/ships.php';
    }
}
