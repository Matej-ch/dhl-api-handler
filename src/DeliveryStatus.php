<?php

namespace matejch\dhlApiHandler;

class DeliveryStatus
{
    public $statusType = [
        150=>'Prevzatie od zákazníka',
        151=>'Prevzatie s výhradou',
        281=>'Príjem zo zahraničia',
        300=>'Príjem na rozvozové depo',
        336=>'Nevyzdvihnutý osobný odber',
        343=>'Doručenie na Parcel shop',
        400=>'Evidencia na PL',
        450=>'Doručené',
        451=>'Doručené nekompletné',
        453=>'Doručené s výhradou',
        454=>'Nedoručené - Nestihol',
        455=>'Nedoručené - neskorý príjazd zásielok na depo',
        456=>'Nedoručené - porucha vozidla',
        457=>'Nedoručené - zlé počasie',
        458=>'Nedoručené - príjemca nezastihnutý / oznámenie',
        459=>'Nedoručené - príjemca nezastihnutý / bez oznámenia',
        460=>'Nedoručené - dohodnutý iný termín',
        461=>'Nedoručené - dohodnutý osobný odber',
        462=>'Nedoručené - dohodnutá iná adresa',
        463=>'Nedoručené - neobjednané',
        464=>'Nedoručené - odmietnuté vyexpedované neskoro',
        465=>'Nedoručené - odmietnuté zásielka nekompletná',
        466=>'Nedoručené - odmietnuté iný dôvod',
        467=>'Nedoručené - adresa neúplná/nenájdená',
        468=>'Nedoručené - nepripravená hotovosť',
        469=>'Nedoručené - dovolenka',
        470=>'Nedoručené - zdržanie na colnici',
        471=>'Nedoručené - chybné alebo chýbajúce doklady',
        472=>'Nedoručené - zásielka poškodená',
        500=>'Príjem na centrálu',
        605=>'Dobierka - príkaz na zákazníka',
        606=>'Dobierka - zaplatené zákazníkovi',
        613=>'Dobierka - píkaz partnerovi',
        614=>'Dobierka - zaplatene partnerovi',
        710=>'Preváženie/váženie',
        718=>'Späť odosielateľovi',
        720=>'Výdaj partnerovi',
        733=>'Príjem na výstupnom depe - zahraničie',
        927=>'Vymazanie',
        929=>'Príjem na iné depo - závlek',
    ];

    public function getStatus(int $code): string
    {
        return $this->statusType[$code];
    }

    public function getStatuses(): array
    {
        return $this->statusType;
    }
}