<?php

namespace matejch\dhlApiHandler;

class Swift
{
    public $swiftcodes = [
        'SUBASKBX'=>'Všeobecná úverová banka, a.s.',
        'GIBASKBX'=>'Slovenská sporiteľňa, a.s.',
        'NBSBSKBX'=>'Národná banka Slovenska',
        'TATRSKBX'=>'Tatra banka, a.s.',
        'SLZBSKB1'=>'Slovenská záručná a rozvojová banka, a.s.',
        'LUBASKBX'=>'ĽUDOVÁ BANKA, a.s. Bratislava',
        'ISTRSKBA'=>'ISTROBANKA, a.s.',
        'INRBSKBX'=>'OTP Banka Slovensko, a.s.',
        'KOMASK2X'=>'Dexia banka Slovensko, a.s.',
        'POBNSKBA'=>'Poštová banka, a.s.',
        'INGBSKBX'=>'ING Bank N.V., pobočka Bratislava',
        'CEKOSKBX'=>'Československá obchodná banka, a.s., pobočka zahraničnej banky v SR',
        'CRLYSKBX'=>'Crédit Agricole SK',
        'COBASKBX'=>'COMMERZBANK Aktiengesellschaft, pobočka zahraničnej banky, Bratislava',
        'KOMBSKBA'=>'KOMERČNÁ BANKA Bratislava, a.s.',
        'BSLOSK22'=>'Privatbanka, a.s.',
        'CITISKBA'=>'Citibank (Slovakia), a.s. Bratislava',
        'KOMBCZPP'=>'Komerčná banka, a.s.',
        'CEKOCZPP'=>'Československá obchodná banka, a.s.',
        'AGBACZPP'=>'GE Money Bank, a.s.',
        'CNBACZPP'=>'Česká národná banka',
        'GIBACZPX'=>'Česká sporiteľňa, a.s.',
        'FIOZSKBA'=>'Fio banka, a.s.',
        'CITICZPX'=>'Citibank a.s.',
        'BACXCZPP'=>'UniCredit Bank Czech Republic a.s.',
        'INGBCZPP'=>'ING Bank N.V.',
        'SOLACZPP'=>'LBBW Bank CZ',
        'CMZRCZP1'=>'Českomoravská záruční a rozvojová banka, a.s.',
        'CRLYCZPP'=>'Crédit Agricole',
        'ABNACZPP'=>'Royal Bank of Scotland',
        'RZBCCZPP'=>'Raiffeisenbank a.s.',
        'JTBPCZPP'=>'J & T Banka, a.s.',
        'PMBPCZPP'=>'PPF banka a.s.',
        'BAPPCZPP'=>'Equa bank',
        'COBACZPX'=>'COMMERZBANK AG, pobočka Praha',
        'GEBACZPP'=>'Fortis Bank SA/NV, pobočka ČR',
        'SUBACZPP'=>'Všeobecná úverová banka a.s., pobočka Praha',
        'VBOECZ2X'=>'Volksbank CZ, a.s.',
        'DEUTCZPX'=>'Deutsche Bank A.G. Filiale Prag',
        'SPWTCZ21'=>'Waldviertler Sparkasse von 1842',
        'OBKLCZ2X'=>'Oberbank AG pobočka Česká republika',
        'CZEECZPP'=>'Česká exportná banka, a.s.',
        'MIDLCZPP'=>'HSBC Bank plc - pobočka Praha',
        'BOTKCZPP'=>'Bank of Tokyo-Mitsubishi UFJ (Holland) N.V., Prague Branch',
        'UNCRSKBX'=>'UniCredit Bank Slovakia a.s.',
        'OBKLSKBA'=>'Oberbank',
        'AKCTCZ22'=>'AKCENTA, sporiteľňa a úverové družstvo',
        'ZUNOCZPP'=>'Zuno',
        'CITFCZPP'=>'CITFIN, sporiteľné družstvo',
        'AIRACZP1'=>'Air Bank',
        'MOBABIC'=>'Moravia Banka, a.s.',
        'UNIVBIC'=>'Universal banka, a.s.',
        'GIBABIC'=>'Erste (CR) a.s. ',
        'KRBABIC'=>'Kreditní banka Plzeň, a.s. ',
        'CBASBIC'=>'Česká banka, a.s. Praha',
        'UNBACZ22'=>'Union banka, a.s.',
        'EAGBBIC'=>'Ekoagrobanka, a.s.',
        'FOREBIC'=>'Fores, a.s.',
        'SOGECZPP'=>'SOCIETE GENERALE, pobočka Praha',
        'PGBABIC'=>'Pragobanka, a.s., zrušena',
        'EBNKCZPP'=>'eBanka, a.s., zrušena',
        'BKAVBIC'=>'Bank Austria a.s., zanikla fúzou',
        'SLEBBIC'=>'Prvá slezská banka a.s., v likvidaci ',
        'EVBABIC'=>'Evrobanka, a.s., v likvidácii',
        'INBACZPP'=>'IP banka, a.s., zrušená',
        'WBKPPLPP'=>'Bank Zachodni WBK SA',
    ];

    public function getBank(string $code): string
    {
        return $this->swiftcodes[$code];
    }

    public function getBanks(): array
    {
        return $this->swiftcodes;
    }
}