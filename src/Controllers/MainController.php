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

    public function index()
    {
        require BASE_DIR . '/src/Views/index.php';
    }

    public function ajax()
    {
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

        require BASE_DIR . '/src/Views/ships.php';
    }
}
