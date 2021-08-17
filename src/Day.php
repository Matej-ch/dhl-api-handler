<?php

namespace matejch\dhlApiHandler;

class Day
{
    public $days = [
        1 => 'Neděle',
        2 => 'Pondělí',
        3 => 'Úterý',
        4 => 'Středa',
        5 => 'Čtvrtek',
        6 => 'Pátek',
        7 => 'Sobota'
    ];

    public function getDay(int $code): string
    {
        return $this->days[$code];
    }

    public function getDays(): array
    {
        return $this->days;
    }
}