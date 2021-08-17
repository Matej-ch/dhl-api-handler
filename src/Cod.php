<?php

namespace matejch\dhlApiHandler;

class Cod
{
    /**
     * Pre metódu GetPackages cod types
     * @var array
     */
    public $forGetpackages = [
        'B2CO'=>'externé',
        'CUST'=>'zákaznícke',
        'PRTN'=>'partnerské',
        'CJJD'=>'JJD',
        'CAWB'=>'AWB',
        'TOAD'=>'Žabka',
        'TDID'=>'Žabka číslo balíka ',
        'DKOD'=>'TP-DKod',
        'PLCE'=>'PL číslo',
        'PJJD'=>'JJD parciel connect',
        'VARS'=>'Variabilný symbol pre nonCOD',
        'TCPF'=>'Poplatok za TCP',
        'OBJP'=>'objednávková preprava',
        'ATPB'=>'atyp Balík',
        'ADRL'=>'ADR LQ',
        'SOSV'=>'sobotný zvoz',
        'ZDRP'=>'Zdravotné prostriedky',
    ];

    public function getCodMessage(string $code): string
    {
        return $this->forGetpackages[$code];
    }

    public function getMessages(): array
    {
        return $this->forGetpackages;
    }
}