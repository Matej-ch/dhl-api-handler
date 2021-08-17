<?php

namespace matejch\dhlApiHandler;

class Country
{
    public $countries = [
        'SK' => "Slovenská republika",
        'CZ' => "Česká republika",
        'PL' => "Poľsko",
        'AT' => "Rakúsko",
        'BE' => "Belgicko",
        'BG' => "Bulharsko",
        'CY' => "Cyprus",
        'DE' => "Nemecko",
        'DK' => "Dánsko",
        'EE' => "Estónsko",
        'GR' => "Grécko",
        'ES' => "Španielsko",
        'FI' => "Fínsko",
        'FR' => "Francúzko",
        'GB' => "Velká Británia",
        'HR' => "Chorvátsko",
        'HU' => "Maďarsko",
        'IE' => "Írsko",
        'IT' => "Taliansko",
        'LT' => "Litva",
        'LU' => "Luxembursko",
        'LV' => "Lotyšsko",
        'MT' => "Malta",
        'NL' => "Holandsko",
        'PT' => "Portugalsko",
        'RO' => "Rumunsko",
        'SE' => "Švédsko",
        'SI' => "Slovinsko",
        'CH' =>"Švajčiarsko",
        'NO' =>"Nórsko",
        'RU' =>"Rusko",
        'TR' =>"Turecko",
        '' => ''
    ];

    public function getList(): array
    {
        return $this->countries;
    }

    public function getCountry(string $code): string
    {
        return $this->countries[$code];
    }
}