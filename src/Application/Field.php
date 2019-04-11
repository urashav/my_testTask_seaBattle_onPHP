<?php

namespace Application;

use Application\Ships\ShipsFactory;
use Application\Ships\Ships;
use mysql_xdevapi\Exception;

class Field
{
    const HORIZONTAL = 10;  // количество горизонтальных клеток
    const VERTICAL = 10;    // Количество вертикальных клеток

    protected $ships; // Массив с кораблями
    protected $field = []; // Матрица координат

    /**
     * Field constructor.
     * @param ShipsFactory $shipsFactory
     * @param $ships
     */
    public function __construct(ShipsFactory $shipsFactory, $ships)
    {
        $this->ships = $shipsFactory->createShip($ships);
    }


    /**
     * @return array
     */
    public function getField(): array
    {
        if ($this->getRandomCoordinates()) {
            return $this->field;
        } else {
            throw new Exception('Не удалось сгенерировать координаты!');
        }
    }

    /**
     * @return bool
     */
    private function getRandomCoordinates(): bool
    {
        // Генерируем матрицу координвт
        $this->field = $this->createMatrix();

        // Получаем координаты кораблей, сливаем с основной матрицей.
        // Переворачиваем массив, проще расставлять корабли от большего к меньшему.
        foreach (array_reverse($this->ships) as $ship) {
            $this->field = array_replace_recursive($this->field, $this->createShipCoordinates($ship));
        }
        return true;
    }

    /**
     * @return array
     */
    private function createMatrix(): array
    {
        $matrix = [];

        for ($x = 0; $x < self::HORIZONTAL; $x++) {
            $matrix[$x] = [];
            for ($y = 0; $y < self::VERTICAL; $y++) {
                $matrix[$x][$y] = 0;
            }
        }
        return $matrix;
    }

    /**
     * @param Ships $ship
     * @return array
     */
    private function createShipCoordinates(Ships $ship)
    {
        $position = [];

        // Получаем количество палуб корабля.
        $decks = $ship->getDecks();

        // Генерируем направление корабля случайным образом.
        // 1 - горизонтальная, 0 вертикальная
        $direction = rand(0, 1);
        $ship->setDirection($direction);

        //  Генерируем начальную позицию в зависимости от ориентации корабля
        if ($direction == 1) {
            $positionX = (rand(0, 10 - $decks));
            $positionY = (rand(0, 9));

            // Делаем проверку на доступность координат.
            // Если координаты недоступны повторяем процесс.
            for ($i = 0; $i < $decks; $i++) {
                if ($this->checkShipCoordinates($positionX + $i, $positionY)) {
                    $position[$positionX + $i][$positionY] = 1;
                } else {
                    return $this->createShipCoordinates($ship);
                }
            }
        } else {
            $positionX = (rand(0, 9));
            $positionY = (rand(0, 10 - $decks));

            // Делаем проверку на доступность координат.
            // Если координаты недоступны повторяем процесс.
            for ($i = 0; $i < $decks; $i++) {
                if ($this->checkShipCoordinates($positionX, $positionY + $i)) {
                    $position[$positionX][$positionY + $i] = 1;
                } else {
                    return $this->createShipCoordinates($ship);
                }
            }
        }
        // Созадем ореол для корабля и возвращаем результат.
        $halo = $this->createHalo($position, $positionX, $positionY, $decks, $direction);
        $position = array_replace_recursive($halo, $position);
        return $position;
    }

    /**
     * @param $positionX
     * @param $positionY
     * @return bool
     */
    private function checkShipCoordinates($positionX, $positionY): bool
    {
        if ($this->field[$positionX][$positionY] != 0) {
            return false;
        }
        return true;
    }

    /**
     * @param $position
     * @param $positionX
     * @param $positionY
     * @param $decks
     * @param $direction
     * @return mixed
     *
     * В зависимости от направления палуб корабля получаем ореол
     */
    private function createHalo($position, $positionX, $positionY, $decks, $direction)
    {
        if ($direction == 1) {
            $firstPositionX = $positionX;
            $firstPositionY = $positionY;
            $lastPositionX = $positionX + $decks - 1;
            $lastPositionY = $positionY;

            $position[$firstPositionX - 1][$firstPositionY - 1] = 2;
            $position[$firstPositionX - 1][$firstPositionY] = 2;
            $position[$firstPositionX - 1][$firstPositionY + 1] = 2;


            $position[$lastPositionX + 1][$lastPositionY] = 2;
            $position[$lastPositionX + 1][$lastPositionY - 1] = 2;
            $position[$lastPositionX + 1][$lastPositionY + 1] = 2;

            foreach ($position as $positionX => $array) {
                foreach ($array as $positionY => $value) {
                    if ($position[$positionX][$positionY] == 1) {
                        $position[$positionX][$positionY - 1] = 2;
                        $position[$positionX][$positionY + 1] = 2;
                    }
                }
            }
        } else {
            $firstPositionX = $positionX;
            $firstPositionY = $positionY;
            $lastPositionX = $positionX;
            $lastPositionY = $positionY + $decks - 1;

            $position[$firstPositionX - 1][$firstPositionY - 1] = 2;
            $position[$firstPositionX][$firstPositionY - 1] = 2;
            $position[$firstPositionX + 1][$firstPositionY - 1] = 2;


            $position[$lastPositionX][$lastPositionY + 1] = 2;
            $position[$lastPositionX - 1][$lastPositionY + 1] = 2;
            $position[$lastPositionX + 1][$lastPositionY + 1] = 2;

            foreach ($position as $positionX => $array) {
                foreach ($array as $positionY => $value) {
                    if ($position[$positionX][$positionY] == 1) {
                        $position[$positionX - 1][$positionY] = 2;
                        $position[$positionX + 1][$positionY] = 2;
                    }
                }
            }
        }
        return $position;
    }
}
