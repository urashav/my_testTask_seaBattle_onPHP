<?php

namespace Application\Ships;

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
                $className = "\\Application\\Ships\\" . $ship;
                $uniqueShipName = $i + 1;
                $result[] = new $className($quantity, $uniqueShipName);
                $i++;
            }
        }
        return $result;
    }
}
