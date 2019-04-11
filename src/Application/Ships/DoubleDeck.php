<?php


namespace Application\Ships;

class DoubleDeck extends Ships
{
    protected $shipName = __CLASS__;
    protected $decks = 2;
    protected $quantity;
}
