<?php

namespace matejch\dhlApiHandler;

class Flags
{
    public $flags = [
        'SD'=> [
            'code' => 'SD',
            'desc' => 'Sobotné doručenie povolené',
        ]
    ];

    public function getFlag(string $code): array
    {
        return $this->flags[$code];
    }

    public function getFlags(): array
    {
        return $this->flags;
    }
}