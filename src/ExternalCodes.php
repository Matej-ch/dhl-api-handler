<?php

namespace matejch\dhlApiHandler;

class ExternalCodes
{
    public $externNumbers = [
        'B2CO' => 'Externé',
        'CUST' => 'Zákaznicke',
        'VARS' => 'Variabilný symbol pre nonCOD'
    ];

    public function getExernalNumber(string $code): string
    {
        return $this->externNumbers[$code];
    }

    public function getExernalNumbers(): array
    {
        return $this->externNumbers;
    }
}