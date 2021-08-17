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
    private $wsdlurl = "https://myapi.dhlparcel.sk/MyAPI.svc?wsdl";

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
        $wsdlurl = $url;
        if(!$wsdlurl) {
            $wsdlurl = $this->wsdlurl;
        }
        $this->client = new SoapClient($wsdlurl,['trace' => 1]);
        $this->username = $username;
        $this->password = $password;
        $this->token = $token;
    }

    /**
     * Login to dhl api
     * @return void
     */
    private function login()
    {
        $input = new stdClass();
        $input->Auth = $this->createAuth();
        $result = $this->client->Login($input);
        if(isset($result->LoginResult, $result->LoginResult->AuthToken)) {
            $this->auth_token = $result->LoginResult->AuthToken;
        }
    }

    public function getCountries()
    {
        return (new Country())->getList();
    }
    public function getPackProductType()
    {
        return self::$productType;
    }
    public function getFlags()
    {
        return self::$flags;
    }
    public function getDirections()
    {
        return self::$directions;
    }
    public function getStatusTypes()
    {
        return self::$statusType;
    }
    public function getDepoTypes()
    {
        return self::$depoType;
    }
    public function getExternNumbers()
    {
        return self::$externNumbers;
    }
    public function getDialServices(){
        return self::$dialServices;
    }
    public function getCurrency()
    {
        return self::$currency;
    }
    public function getBanks()
    {
        return self::$banks;
    }
    public function getSwiftCodes()
    {
        return self::$swiftcodes;
    }
    public function getDays()
    {
        return self::$days;
    }
    public function getFunctionReturnTypes()
    {
        return self::$functionReturnValues;
    }
    public function getPackProductTypeWithCod()
    {
        return self::$productTypeWithCod;
    }
    public function getForGetPackages()
    {
        return self::$forGetpackages;
    }
    public function getAllowedCurrencies()
    {
        return self::$allowedCurrencies;
    }

}