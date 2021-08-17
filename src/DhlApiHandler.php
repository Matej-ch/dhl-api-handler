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

}