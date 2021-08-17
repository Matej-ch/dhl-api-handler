<?php

namespace matejch\dhlApiHandler;

class Directions
{
    public $directions = [
        'IN'=>'Vstupný smer',
        'OUT'=>'Výstupný smer',
        'OUT_SD'=>'Výstupný smer sobotného doručenia',
    ];

    public function getDirection(string $code): string
    {
        return $this->directions[$code];
    }

    public function getDirections(): array
    {
        return $this->directions;
    }
}