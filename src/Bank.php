<?php

namespace matejch\dhlApiHandler;

class Bank
{
    public $banks = [
        '0200'=>'Všeobecná úverová banka, a.s.',
        '0900'=>'Slovenská sporiteľňa, a.s.',
        '0720'=>'Národná banka Slovenska',
        '1100'=>'Tatra banka, a.s.',
        '3000'=>'Slovenská záručná a rozvojová banka, a.s.',
        '3100'=>'ĽUDOVÁ BANKA, a.s. Bratislava',
        '4900'=>'ISTROBANKA, a.s.',
        '5200'=>'OTP Banka Slovensko, a.s.',
        '5600'=>'Dexia banka Slovensko, a.s.',
        '6500'=>'Poštová banka, a.s.',
        '7300'=>'ING Bank N.V., pobočka Bratislava',
        '7500'=>'Československá obchodní banka, a.s., pobočka zahraničnej banky v SR',
        '8020'=>'Crédit Agricole SK',
        '8050'=>'COMMERZBANK Aktiengesellschaft, pobočka zahraničnej banky, Bratislava',
        '8100'=>'KOMERČNÍ BANKA Bratislava, a.s.',
        '8120'=>'Privatbanka, a.s.',
        '8130'=>'Citibank (Slovakia), a.s. Bratislava',
        '100'=>'Komerčná banka, a.s.',
        '300'=>'Československá obchodní banka, a.s.',
        '600'=>'GE Money Bank, a.s.',
        '710'=>'Česká národná banka',
        '800'=>'Česká sporiteľňa, a.s.',
        '2010'=>'Fio banka, a.s.',
        '2250'=>'Creditas',
        '2600'=>'Citibank a.s.',
        '2700'=>'UniCredit Bank Czech Republic a.s.',
        '3500'=>'ING Bank N.V.',
        '4000'=>'LBBW Bank CZ',
        '4300'=>'Českomoravská záručná a rozvojová banka, a.s.',
        '5000'=>'Crédit Agricole',
        '5400'=>'Royal Bank of Scotland',
        '5500'=>'Raiffeisenbank a.s.',
        '5800'=>'J & T Banka, a.s.',
        '6000'=>'PPF banka a.s.',
        '6100'=>'Equa bank',
        '6200'=>'COMMERZBANK AG, pobočka Praha',
        '6300'=>'Fortis Bank SA/NV, pobočka ČR',
        '6700'=>'Všeobecná úverová banka a.s., pobočka Praha',
        '6800'=>'Volksbank CZ, a.s.',
        '7910'=>'Deutsche Bank A.G. Filiale Prag',
        '7940'=>'Waldviertler Sparkasse von 1842',
        '7950'=>'Raiffeisen stavební sporiteľňa a.s.',
        '7960'=>'Českomoravská stavebná sporiteľňa, a.s.',
        '7970'=>'Wüstenrot-stavebná sporiteľňa a.s.',
        '7980'=>'Wüstenrot hypotekarná banka, a.s. zo sídlom v Praze',
        '7990'=>'Modrá pyramida stavebná sporiteľňa, a.s.',
        '8030'=>'Raiffeisenbank im Stiftland eG pobočka Cheb, odštepný závod',
        '8040'=>'Oberbank AG pobočka Česká republika',
        '8060'=>'Stavebná sporiteľňa Českéj sporiteľne, a.s.',
        '8090'=>'Česká exportná banka, a.s.',
        '8150'=>'HSBC Bank plc - pobočka Praha',
        '2020'=>'Bank of Tokyo-Mitsubishi UFJ (Holland) N.V., Prague Branch',
        '1111'=>'UniCredit Bank Slovakia a.s.',
        '6210'=>'mBank',
        '8330'=>'Fio banka, a.s., pobočka zahraničnej banky',
        '8370'=>'Oberbank',
        '2030'=>'AKCENTA, sporiteľňa a úverové družstvo',
        '2070'=>'Moravský peněžný ústav',
        '2050'=>'WPB Capital, sporiteľné družstvo',
        '2100'=>'Hypotečná banka',
        '2200'=>'Peňažný dom',
        '2230'=>'AXA Bank Europe',
        '8300'=>'HSBC BANK PLC pobočka Slovensko',
        '2040'=>'UNIBON – sporiteľňa a úverové družstvo',
        '8410'=>'ZUNO BANK AG, pobočka zahraničnej banky',
        '2310'=>'Zuno',
        '2060'=>'CITFIN, sporiteľné družstvo',
        '3030'=>'Air Bank',
        '8350'=>'RBS Slovakia',
        '4500'=>'Moravia Banka, a.s.',
        '3800'=>'HYPO Vereinsbank CZ a.s',
        '6400'=>'Universal banka, a.s.',
        '4400'=>'Erste (CR) a.s.',
        '2000'=>'Kreditná banka Plzeň, a.s.',
        '4100'=>'Česká banka, a.s. Praha',
        '3400'=>'Union banka, a.s.',
        '1800'=>'Ekoagrobanka, a.s.',
        '7920'=>'Fores, a.s.',
        '1900'=>'SOCIETE GENERALE, pobočka Praha',
        '51'=>'Fiktívna banka 1',
        '400'=>'Fiktívna banka 2',
        '1600'=>'Pragobanka, a.s., zrušená',
        '3900'=>'HYPO-BANK CZ a.s., zanikla fúzou',
        '10'=>'Fiktívna banka 3',
        '2400'=>'eBanka, a.s., zrušená',
        '2800'=>'Bank Austria a.s., zanikla fúzou',
        '5300'=>'Prvná slezská banka a.s., v likvidácii',
        '3200'=>'Evrobanka, a.s., v likvidácii',
        '0'=>'Fiktívna banka 4',
        '8010'=>'Fiktívna banka 5',
        '598'=>'Fiktívna banka 6',
        '2222'=>'Fiktívna banka 8',
        '2210'=>'Evropsko-ruská banka, a.s.',
        '30'=>'Fiktívna banka 10',
        '60'=>'Fiktívna banka 15',
        '5100'=>'IP banka, a.s., zrušená',
        '8360'=>'Fiktívna banka 17',
        '10901014'=>'Bank Zachodni WBK SA',
    ];

    public function getBank(string $code): string
    {
        return $this->banks[$code];
    }

    public function getBanks(): array
    {
        return $this->banks;
    }
}