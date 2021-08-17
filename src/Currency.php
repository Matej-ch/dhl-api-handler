<?php

namespace matejch\dhlApiHandler;

class Currency
{
    public $currency = [
        'CZK'=>'Česká koruna',
        'EUR'=>'Euro',
        'PLN'=>'Polský zloty',
    ];

    public $allowedCurrencies = [
        'CZK' =>['currency_id'=>1,'country_code'=>'CZ'],
        'EUR' =>['currency_id'=>4,'country_code'=>'SK'],
        'PLN' =>['currency_id'=>16,'country_code'=>'PL'],
    ];

    public function getCurrency(string $code): string
    {
        return $this->currency[$code];
    }

    public function getCurrencies(): array
    {
        return $this->currency;
    }

    public function getAllowedCurrency(string $code): array
    {
        return $this->allowedCurrencies[$code];
    }

    public function getAllowedCurrencies(): array
    {
        return $this->allowedCurrencies;
    }
}