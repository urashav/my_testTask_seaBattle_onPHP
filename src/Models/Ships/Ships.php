<?php


namespace Models\Ships;

abstract class Ships
{
    protected $shipName;    // Имя корабля
    protected $uniqueShipName;    // Уникальное имя корабля
    protected $decks;       // Количество палуб
    protected $quantity;    // Количество кораблей
    protected $directionX;  // 1 - горизонтальная, 0 вертикальная

    /**
     * Ships constructor.
     * @param $quantity
     * @param $uniqueShipName
     * @throws \ReflectionException
     */
    public function __construct($quantity, $uniqueShipName)
    {
        $reflection = new \ReflectionClass($this);
        $this->shipName = $reflection->getShortName();

        $this->quantity = $quantity;
        $this->uniqueShipName = $this->shipName . '_' . $uniqueShipName;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return get_class($this);
    }

    /**
     * @return mixed
     */
    public function getDecks(): int
    {
        return $this->decks;
    }

    /**
     * @return string
     */
    public function getShipName(): string
    {
        return $this->shipName;
    }

    /**
     * @return string
     */
    public function getUniqueShipName(): string
    {
        return $this->uniqueShipName;
    }

    /**
     * @return mixed
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param mixed $directionX
     */
    public function setDirection($directionX): void
    {
        $this->direction = $directionX;
    }

    /**
     * @return mixed
     */
    public function getDirection(): int
    {
        return $this->direction;
    }
}
