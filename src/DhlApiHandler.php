<?php

namespace matejch\dhlApiHandler;

use SoapClient;
use SoapFault;
use stdClass;

class DhlApiHandler
{

    /**
     * @var string default url for SOAP
     */
    private $wsdlUrl = "https://myapi.dhlparcel.sk/MyAPI.svc?wsdl";

    /**
     * @var string username for DHL API
     */
    private $username;

    /**
     * @var string password for DHL API
     */
    private $password;

    /**
     * @var string token for DHL API
     */
    private $token;

    private $authToken;

    /**
     * @var SoapClient
     */
    private $client = null;

    /**
     * DhlApiHandler constructor.
     * @param string $username
     * @param string $password
     * @param string $token
     * @param string|null $url
     * @throws SoapFault
     */
    public function __construct(string $username, string $password, string $token, string $url = null)
    {
        if($url) {
            $this->wsdlUrl = $url;
        }

        $this->client = new SoapClient($this->wsdlUrl,['trace' => 1]);
        $this->username = $username;
        $this->password = $password;
        $this->token = $token;
    }

    /**
     * Login to dhl api
     * @return void
     */
    public function login(): void
    {
        $input = new stdClass();
        $input->Auth = $this->createAuth();
        $result = $this->client->Login($input);
        if(isset($result->LoginResult, $result->LoginResult->AuthToken)) {
            $this->authToken = $result->LoginResult->AuthToken;
        }
    }

    /**
     * Create auth object
     * @return stdClass
     */
    public function createAuth(): stdClass
    {
        $auth = new stdClass();
        $auth->CustId = $this->token;
        $auth->UserName = $this->username;
        $auth->Password = $this->password;
        if(!empty($this->authToken)) {
            $auth->AuthToken = $this->authToken;
        }
        return $auth;
    }

    /**
     * Show API version
     * @throws \Exception
     */
    public function apiVersion()
    {
        try {
            $result = $this->client->Version();
        } catch (SoapFault $e) {
            throw new \Exception($e);
        }
        return $result;
    }

    /**
     * Check if connection to dhl is healthy
     * @return mixed
     * @throws \Exception
     */
    public function isHealthy()
    {
        try{
            $result = $this->client->IsHealtly();
        }catch (SoapFault $e){
            throw new \Exception($e);
        }
        return $result;
    }

    /**
     * Get list of parcel shops for country or for specific code
     * @param string $code
     * @param string $countryCode
     * @return array|bool
     * @throws \Exception
     */
    public function getParcelShops(string $code = '', string $countryCode = 'SK')
    {
        try {
            $input = new stdClass();
            $input->Filter = new stdClass();
            if(!empty($code)) {
                $input->Filter->Code = $code;
            }
            if(!empty($countryCode)) {
                $input->Filter->CountryCode = $countryCode;
            }
            if(empty($input->Filter->Code) && empty($input->Filter->CountryCode)) {
                return [];
            }
            $result = $this->client->GetParcelShops($input);
        } catch (SoapFault $e) {
            throw new \Exception($e);
        }
        return $result;

    }

    /**
     * Get cities routing
     * @param null $countryCode
     * @param null $zipcode
     * @param null $dateFrom
     * @return bool
     */
    public function getCitiesRouting($countryCode = null,$zipcode= null,$dateFrom=null)
    {
        $input = new stdClass();
        $input->Auth = $this->createAuth();
        $input->Filter = new stdClass();
        $input->Filter->CountryCode = $countryCode ?? 'SK';

        if(isset($zipcode) && !empty($zipcode)) {
            $input->Filter->ZipCode = $zipcode;
        }

        if(isset($dateFrom) && !empty($dateFrom)) {
            $input->Filter->DateFrom = $dateFrom;
        }

        return $this->client->GetCitiesRouting($input);
    }

    /**
     * Get DHL packages from api
     * @param $custRefs
     * @param array|null $packNumbers can be multiple numbers must be sent as array, otherwise error
     * @param $dateFrom
     * @param $dateTo
     * @return mixed
     */
    public function getPackages($custRefs, array $packNumbers = null, $dateFrom = null, $dateTo = null)
    {
        $input = new stdClass();
        $input->Auth = $this->createAuth();
        $input->Filter = new stdClass();

        if(isset($custRefs) && !empty($custRefs)) {
            $input->Filter->CustRefs = $custRefs;
        }

        if(isset($packNumbers) && !empty($packNumbers)) {
            $input->Filter->PackNumbers = $packNumbers;
        }

        if(isset($dateFrom) && !empty($dateFrom)) {
            $input->Filter->DateFrom = $dateFrom;
        }

        if(isset($dateTo) && !empty($dateTo)) {
            $input->Filter->DateTo = $dateTo;
        }

        return $this->client->GetPackages($input);
    }

    /**
     * Balík z ľubovoľnej adresy
     * Metóda CreateOrders je určená k vytvoreniu objednávky pre prepravu zásielky z miesta „A“
     * do miesta „B“ pokiaľ nie je vopred zadefinované číslo zásielky z číselnej rady. Zásielka bude
     * vyzdvihnutá kuriérom v mieste „A“ na základe vyplnených údajov objednávky.
     *
     * Vyzdvihnutie balíka inde, než je zmluvne dané. Balíky nie sú označené štítkom a platiteľ je objednávateľ.
     * Netlačí sa prepravný štítok, generuje sa na strane DHL na základe objednávky, kuriér príde na miesto vyzdvihnutia
     * s pripraveným prepravným štítkom.
     * @param array $order
     * @return mixed
     * @internal param $orders
     */
    public function createOrders(array $order): array
    {
        $input = new stdClass();
        $input->Auth = $this->createAuth();
        $input->Orders = new stdClass();
        $input->Orders->MyApiOrderIn = new stdClass();
        $input->Orders->MyApiOrderIn->Sender = $this->createSender($order['Sender']);
        $input->Orders->MyApiOrderIn->Recipient = $this->createRecipient($order['Recipient']);

        /** mandatory arguments */
        $input->Orders->MyApiOrderIn->CountPack = $order['CountPack'];
        $input->Orders->MyApiOrderIn->OrdRefID = $order['OrderRefID'];
        $input->Orders->MyApiOrderIn->PackProductType = $order['PackProductType'];
        $input->Orders->MyApiOrderIn->SendDate = $order['SendDate'];

        /** optional arguments */
        $input->Orders->MyApiOrderIn->Email = $order['Email'] ?? '';
        $input->Orders->MyApiOrderIn->Note = $order['Note'] ?? '';

        $response = $this->client->CreateOrders($input);
        if((int)$response->CreateOrdersResult->ResultData->ItemResult->Code !== 0) {
            return ['success' => false,
                'message' => $response->CreateOrdersResult->ResultData->ItemResult->Message ?? '',
                'code' => $response->CreateOrdersResult->ResultData->ItemResult->Code];
        }

        return ['success' => true, 'message' => self::getFunctionReturnTypes()[0]];
    }

    /**
     * Create recipient object, with option to add only required attributes
     * @param array $recipientData
     * @param bool $requiredOnly if you only want to send required params for api
     * @return stdClass
     */
    private function createRecipient(array $recipientData,bool $requiredOnly = false): stdClass
    {
        return $this->createAddressData($recipientData, $requiredOnly = false);
    }

    /**
     * Create sender object, with option to add only required attributes
     * @param array $senderData
     * @param bool $requiredOnly
     * @return stdClass
     */
    private function createSender(array $senderData, bool $requiredOnly = false): stdClass
    {
        return $this->createAddressData($senderData, $requiredOnly = false);
    }

    private function createAddressData(array $data, bool $requiredOnly = false): stdClass
    {
        $addressObj = new stdClass();
        $addressObj->City = $data['City'];
        $addressObj->Name = $data['Name'];
        $addressObj->Street = $data['Street'];
        $addressObj->ZipCode = $data['ZipCode'];
        $addressObj->Country = $data['Country'];
        if(!$requiredOnly) {
            $addressObj->Contact = $data['Contact'];
            $addressObj->Email = $data['Email'];
            $addressObj->Name2 = $data['Name2'];
            $addressObj->Phone = $data['Phone'];
        }
        return $addressObj;
    }

    /**
     * Create payment info object
     * @param array $paymentInfo
     * @param array $packageInfo
     * @param bool $isFirst
     * @return stdClass
     */
    private function createPaymentInfo(array $paymentInfo, array $packageInfo, bool $isFirst = true): stdClass
    {
        $payment = new stdClass();

        if((!isset($paymentInfo['IBAN']) || empty($paymentInfo['IBAN'])) &&
            (!isset($paymentInfo['Swift']) || empty($paymentInfo['Swift']))){
            $payment->BankAccount = $paymentInfo['BankAccount'];
            $payment->BankCode = $paymentInfo['BankCode'];
        }

        $payment->CodCurrency = $packageInfo['currency'];
        if($isFirst) {
            $payment->CodPrice = round((float)$packageInfo['price'], 4);
        } else {
            $payment->CodPrice = 0.00;
        }
        $payment->CodVarSym = $paymentInfo['CodVarSym'];

        if(isset($paymentInfo['InsurCurrency']) && !empty($paymentInfo['InsurCurrency'])) {
            $payment->InsurCurrency = $paymentInfo['InsurCurrency'];
        }

        if(isset($paymentInfo['InsurPrice']) && !empty($paymentInfo['InsurPrice'])){
            $payment->InsurPrice = $paymentInfo['InsurPrice'];
            $payment->SpecSymbol = $paymentInfo['SpecSymbol'];
        }

        if((!isset($payment->BankAccount) || empty($payment->BankAccount)) &&
            (!isset($payment->BankCode) || empty($payment->BankCode))){
            $payment->IBAN = $paymentInfo['IBAN'];
            $payment->Swift = $paymentInfo['SWIFT'];
        }
        return $payment;
    }

    /**
     * Metóda CreatePackages je určená na odoslanie údajov zásielok pre ktoré má klient pridelenú číselnú radu a tlačí štítky.
     * Metóda je obmedzená na 1000 zásielok na request.
     * @param array $packageInfo
     * @param string $packageNumber
     * @param bool $isFirstPackage
     * @return array
     */
    public function createPackage(array $packageInfo, string $packageNumber, bool $isFirstPackage = true): array
    {

        $input = new stdClass();
        $input->Auth = $this->createAuth();
        $input->Packages = new stdClass();
        $input->Packages->MyApiPackageIn = new stdClass();
        $input->Packages->MyApiPackageIn->Sender = $this->createSender($packageInfo['Sender']);
        $input->Packages->MyApiPackageIn->Recipient = $this->createRecipient($packageInfo['Recipient']);

        if(isset($packageInfo['PackageInfo']['CashOnDelivery']) && !empty($packageInfo['PackageInfo']['CashOnDelivery'])) {
            $input->Packages->MyApiPackageIn->PaymentInfo = $this->createPaymentInfo($packageInfo['PaymentInfo'], $packageInfo['PackageInfo'], $isFirstPackage);
        }

        if(isset($packageInfo['PackageInfo']['satDelivery']) && !empty($packageInfo['PackageInfo']['satDelivery'])) {
            $input->Packages->MyApiPackageIn->Flags = $this->createMyApiFlag();
        }

        $input->Packages->MyApiPackageIn->PackNumber = $packageNumber;
        $input->Packages->MyApiPackageIn->PackProductType = $packageInfo['PackageInfo']['PacktProductType'];

        if(isset($packageInfo['PackageInfo']['Note']) && !empty($packageInfo['PackageInfo']['Note'])) {
            $input->Packages->MyApiPackageIn->Note = $packageInfo['PackageInfo']['Note'];
        }

        if(isset($packageInfo['PackageInfo']['ExternNumbers']) && array_key_exists('Code', $packageInfo['PackageInfo']['ExternNumbers']) &&
            array_key_exists('ExtNumber', $packageInfo['PackageInfo']['ExternNumbers']) &&
            !empty($packageInfo['PackageInfo']['ExternNumbers']['ExtNumber']) &&
            !empty($packageInfo['PackageInfo']['ExternNumbers']['Code'])) {
                $input->Packages->MyApiPackageIn->PackagesExtNums = $this->createExtNumbers($packageInfo['PackageInfo']['ExternNumbers']);
            }

        $response = $this->client->CreatePackages($input);

        if((int)$response->CreatePackagesResult->ResultData->ItemResult->Code !== 0) {
            return ['success' => false,
                'message' => $response->CreatePackagesResult->ResultData->ItemResult->Message ?? '',
                'ItemKey' => $response->CreatePackagesResult->ResultData->ItemResult->ItemKey ?? '',
                'code' => $response->CreatePackagesResult->ResultData->ItemResult->Code];
        }

        return ['success' => true, 'ItemKey' => $response->CreatePackagesResult->ResultData->ItemResult->ItemKey ?? ''];
    }

    private function createMyApiFlag()
    {
        $flags = new stdClass();
        $flags->MyApiFlag = new stdClass();
        $flags->MyApiFlag->Code = self::getFlags()['SD']['code'];
        $flags->MyApiFlag->Value = true;
        return $flags;
    }

    private function createExtNumbers(array $extNumbers)
    {
        $packagesExtNums = new stdClass();
        $packagesExtNums->MyApiPackageExtNum = new stdClass();
        $packagesExtNums->MyApiPackageExtNum->Code = $extNumbers['Code'];
        $packagesExtNums->MyApiPackageExtNum->ExtNumber = $extNumbers['ExtNumber'];
        return $packagesExtNums;
    }

    public static function getCountries(): array
    {
        return (new Country())->getList();
    }

    public static function getPackProductType(): array
    {
        return (new Products())->getProductTypes();
    }

    public static function getFlags(): array
    {
        return (new Flags())->getFlags();
    }

    public static function getDirections(): array
    {
        return (new Directions())->getDirections();
    }

    public static function getStatusTypes(): array
    {
        return (new DeliveryStatus())->getStatuses();
    }

    public static function getDepoTypes(): array
    {
        return (new Depo())->getDepos();
    }

    public static function getExternNumbers(): array
    {
        return (new ExternalCodes())->getExernalNumbers();
    }

    public static function getDialServices(): array
    {
        return (new DialService())->getServices();
    }

    public static function getCurrency(): array
    {
        return (new Currency())->getCurrencies();
    }

    public static function getBanks(): array
    {
        return (new Bank())->getBanks();
    }

    public static function getSwiftCodes(): array
    {
        return (new Swift())->getBanks();
    }

    public static function getDays(): array
    {
        return (new Day())->getDays();
    }

    public static function getFunctionReturnTypes(): array
    {
        return (new ErrorMessage())->getMessages();
    }

    public static function getPackProductTypeWithCod(): array
    {
        return (new Products())->getProductTypesWithCod();
    }

    public static function getForGetPackages(): array
    {
        return (new Cod())->getMessages();
    }

    public static function getAllowedCurrencies(): array
    {
        return  (new Currency())->getAllowedCurrencies();
    }

    /**
     * Get numbers from number range for user (user is user for dhl api)
     * Every product type can have different number range
     * @param $packtProductType
     * @param int $quantity number of numbers required for system
     * @return mixed
     */
    public function getNumberRange($packtProductType,int $quantity)
    {
        $input = new stdClass();
        $input->Auth = $this->createAuth();
        $input->NumberRanges = new stdClass();
        $input->NumberRanges->NumberRangeRequest = new stdClass();
        $input->NumberRanges->NumberRangeRequest->PackProductType = $packtProductType;
        $input->NumberRanges->NumberRangeRequest->Quantity = $quantity;
        return $this->client->GetNumberRange($input);
    }
    
    /**
     * Add check digit to number string
     * @param string $packageNumber
     * @return string
     */
    public function addCheckDigit(string $packageNumber): string
    {
        $sum = $sumEvenPos = 0;
        $length = strlen($packageNumber);
        for ($i = 0;$i < $length;$i++) {
            if($i % 2 === 0) {
                $sum += (int)$packageNumber[$i];
            } else {
                $sumEvenPos += (int)$packageNumber[$i];
            }
        }
        $sum = ($sum * 3) + $sumEvenPos;
        $sum = (int)((ceil($sum / 10) * 10) - $sum);
        return (string)$packageNumber . $sum;
    }

    /**
     * Add one correctly to number bigger than integer as string
     * @param string $from
     * @return string
     */
    public static function addOneToBigNumber(string $from): string
    {
        $iteratedNumber = '';
        $firstIteration = true;
        for($i = strlen($from)-1;$i >=0;$i--) {
            if($firstIteration) {
                $temp = (int)$from[$i] + 1;
                if($temp >= 10) {
                    $temp = 0;
                    $carryOver = 1;
                }
            } else {
                if(isset($carryOver) && $carryOver === 1) {
                    $temp = (int)$from[$i] + $carryOver;
                } else {
                    $temp = (int)$from[$i];
                }
                if($temp >= 10) {
                    $temp = 0;
                    $carryOver = 1;
                } else {
                    $carryOver = null;
                }
            }
            $iteratedNumber .= $temp;
            $firstIteration = false;
        }
        return strrev($iteratedNumber);
    }
}