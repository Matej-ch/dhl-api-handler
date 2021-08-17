<?php

namespace matejch\dhlApiHandler;

class DialService
{
    public $dialServices = [
        'B2OC'=>'Dopravné',
        'TOLL'=>'Mýtne',
        'FUEL'=>'Palivový príplatok',
        'COD'=>'Dobierka',
        'PMTC'=>'Platba v hotovosti odosielateľom',
        'ADR'=>'ADR',
        'INSR'=>'Pripoistenie',
        'TD'=>'Ďalší pokus o doručenie',
        'POD'=>'Potvrdenie o doručení',
        'SD'=>'Sobotné doručenie',
        'PPCK'=>'Osobný odber',
        'DB'=>'Dokumenty späť',
        'PBC'=>'Platba kartou',
        'PERG'=>'Osobný podaj',
        'TLSK'=>'Mýtne CZ',
    ];

    public function getService(string $code): string
    {
        return $this->dialServices[$code];
    }

    public function getServices(): array
    {
        return $this->dialServices;
    }
}