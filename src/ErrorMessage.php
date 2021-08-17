<?php

namespace matejch\dhlApiHandler;

class ErrorMessage
{
    /**
     * @var array
     */
    public $functionReturnValues = [
        0 => 'Úspešne načítané',
        1025 => 'Cena poistenia a menu musia byť oba vyplnené',
        1000 => 'Nesprávne alebo chýbajúce číslo balíka',
        1026 => 'Poistenie je negatívna cena',
        1001 => 'Neznámy typ produktu',
        1027 => 'Unknown COD currency',
        1002 => 'Nesprávna adresa odosielateľa' ,
        1028 => 'Unknown insurance currency',
        1003 => 'Nesprávna adresa príjemcu',
        1029 => 'Unknown package service',
        1004 => 'Neplatný COD variabilný symbol',
        1030 => 'Neznáme externé číslo',
        1005 => 'Neplatný špeciálny symbol',
        1031 => 'Neplatná krajina v odosielateľskej adrese',
        1006 => 'COD price and COD currency not filled both',
        1032 => 'Invalid country in recipient address',
        1007 => 'COD negatívna cena',
        1033 => 'Invalid informations about weighted packages',
        1008 => 'Invalid bánk informations - filled bánk account / code and also IBAN/ SWIFT',
        1034 => 'Neznáme trasy',
        1009 => 'Bank account and bánk code must be filled both',
        1035 => 'Invalid package weight',
        1010 => 'IBAN and SWIFT must be filled both',
        1036 => 'Saturday delivery filled and saturday route not or vice versa',
        1011 => 'Neznáme číslo banky',
        1037 => 'Chýbajúca vstupná destinácia',
        1012 => 'Neznámy SWIFT code',
        1038 => 'Missing output destination',
        1013 => 'Filled COD informations for nonCOD product' ,
        1039 => 'Filled route type in and not route type out or vice versa. Two times filled route type out or route type in.',
        1014 => 'Invalid count of collies',
        1040 => 'Unknown Package flag',
        1015 => 'Pallets - Colli number must be specified',
        2001 => 'Bad sender address',
        1016 => 'Pallets - Colli number must be unique',
        2002 => 'Nesprávny počet balíkov',
        1017 => 'Palety - nesprávna veľkosť',
        2005 => 'Invalid country in sender address',
        1018 => 'Pallets - unknown wrap code',
        3001 => 'Nesprávna adresa príjemcu',
        1019 => 'Pallets - unknown manipulation type',
        3002 => 'Nesprávna adresa odosielateľa',
        1020 => 'Pallets - unknown pickup cargo type',
        3003 => 'Nesprávny počet balíkov',
        1021 => 'Pallets - parciel shop can not be filled for pallet shipment',
        3004 => 'Unknown product type for package',
        1022 => 'Pallets - pallet information for nonpallet shipment',
        3005 => 'Invalid country in sender address',
        1023 => 'Unknown parciel shop code' ,
        3006 => 'Invalid country in recipient address',
        1024 => 'Invalid package weight',
        4000 => 'You have already unsused numbers of requested range, contact sales or technician or IT',
        4001 => 'Takýto typ produktu neexistuje',
        4002 => 'Quantity is above maximum',
        4003 => 'Quantity is bellow minimum',
        1 => 'Vytvorenie objednávky zlyhalo',
        3007 => 'SendDate must be equal or greater than the current date.',
        3008 => 'Parameter SendDate must be filled',
        3010 => 'Duplicít OrdRefId: "OrdRefID"(Duplicitné OrdRefID)',
        3011 => 'Count of orders is greater than "max limit pre počet objednávok" (Súčasné nastavenie: 500)',
        2006 => 'SendDate must be equal or greater than the current date',
        2008 => 'Parameter SendDate must be filled',
        1041  => 'Invalid colli weight (min: 0 kg, max: 800 kg)',
        1043  => 'SD flag can not be specified for this Product type',
        1045  => 'Parameter mismatch: Colli WrapCode and PEURCount',
        1046 => '"Recipient coutry" ZipCode wrong, check the format',
        1047  => 'Bad sender ZipCode format',
        1048  => 'Parameter SpecTakeDate must be specified',
        1049 => 'COD price is greater than the maximum allowable limit for the country',
        1050  => 'Maximum number of packages "limit max počet zásielok" exceeded (1000)',
        1051 => 'Hodnota\',pripoistenia nie je číslo - Hodnota\',dobierky nie je číslo - Počet zásielok nie je číslo',
        1052  => 'The PackNumber is required field (PackNumber je povinné pole)',
        1053  => 'Duplicít PackNumber: "PackNumber"',
        1054  => 'Unknown COD currency',
        1055  => 'Maximum number of packages "limit max počet zásielok" exceeded',
        1057  => 'The PackNumber is required field',
        1058  => 'Duplicít PackNumber: "PackNumber"',
        1059  => 'Package "PackNumber" is not authorized to create back documents',
        1060  => 'Package: "PackNumber", DocumentsBack PackNumber is missing',
        1061  => 'Package: "PackNumber", Service with code DB is missing.',
        1062  => 'Invalid recipient address for back documents',
        1063  => 'Recipient ZIP code does not support morning delivery',
    ];

    public function getErrorMessage(int $code): string
    {
        return $this->functionReturnValues[$code] ?? 'Unknown error code';
    }

    public function getMessages(): array
    {
        return $this->functionReturnValues;
    }
}