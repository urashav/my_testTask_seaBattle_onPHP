<?php

namespace Models\Ships;

class ShipsFactory
{
    /**
     * @param array $ships
     * @return array
     */
    public function createShip(array $ships): array
    {
        $result = [];

        foreach ($ships as $ship => $quantity) {
            $i = 0;
            while ($i < $quantity) {
                $uniqueShipName = $i + 1;
                switch ($ship) {
                    case 'SingleDeck':
                        $result[] = new SingleDeck($quantity, $uniqueShipName);
                        break;
                    case 'DoubleDeck':
                        $result[] = new DoubleDeck($quantity, $uniqueShipName);
                        break;
                    case 'TripleDeck':
                        $result[] = new TripleDeck($quantity, $uniqueShipName);
                        break;
                    case 'FourDeck':
                        $result[] = new FourDeck($quantity, $uniqueShipName);
                        break;
                    default:
                        echo 'Неверное значение корабля';
                }

                $i++;
            }
        }
        return $result;
    }
}
