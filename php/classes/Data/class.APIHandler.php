<?php

class APIHandler {
    private $NSApiConfig;

    function __construct()
    {
        $this->NSApiConfig = new NSApiConfig();
    }


    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new APIHandler();
        }
        return $instance;
    }

    public function getVertrekTijden($station)
    {
        $parameters = array(
            'station' => $station
        );
        return $this->getXMLContent("http://webservices.ns.nl/ns-api-avt",$parameters);
    }

    public function getXMLContent($url, $parameters){
        $loginDetails = $this->NSApiConfig->getConfig();

        if(!empty($parameters)){
            $url .= '?' . http_build_query($parameters);
        }

        $ch = curl_init( $url );
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, $loginDetails['username'] .":". $loginDetails['password']);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $xml = curl_exec($ch);
        curl_close($ch);
        return $xml;
    }
}