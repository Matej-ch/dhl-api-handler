<?php

namespace matejch\dhlApiHandler;

class Depo
{
    public $depoType = [
        50 => 'HQ Bratislava',
        51 => 'Bratislava',
        52 => 'Žilina',
        53 => 'Banská Bystrica',
        54 => 'Košice',
        59 => 'HUB Bratislava',
        58 => 'HUB Žilina',
    ];

    public function getDepo(int $code): string
    {
        return $this->depoType[$code];
    }

    public function getDepos(): array
    {
        return $this->depoType;
    }
}