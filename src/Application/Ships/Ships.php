<?php


namespace Application\Ships;

abstract class Ships
{
    protected $shipName;    // Имя корабля
    protected $uniqueShipName;    // Уникальное имя корабля
    protected $decks;       // Количество палуб
    protected $quantity;    // Количество кораблей
    protected $direction;  // 1 - горизонтальная, 0 вертикальная

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
    public function __toString()
    {
        return get_class($this);
    }

    /**
     * @return mixed
     */
    public function getDecks()
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
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $direction
     */
    public function setDirection($direction): void
    {
        $this->direction = $direction;
    }

    /**
     * @return mixed
     */
    public function getDirection()
    {
        return $this->direction;
    }

}
