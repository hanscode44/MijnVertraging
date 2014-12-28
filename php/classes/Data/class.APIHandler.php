<?php

class APIHandler extends Singleton{
    private $NSApiConfig;

    function __construct() {
        $this->NSApiConfig = new NSApiConfig();
    }

    public function getVertrekTijden($station) {

        $url = 'http://webservices.ns.nl/ns-api-avt';
        $parameters = array(
            'station' => $station
        );
        $cacheName = "vertrekTijden" . implode("", $parameters);
        $cacheDuration = 60; // 1 minuut

        return CacheHandler::getInstance()->getCachedXMLFile($cacheName, $cacheDuration, $url, $parameters);
    }

    public function getStations(){
        $cacheName = 'stations';
        $cacheDuration = 60 * 60 * 24; // 24 uur
        $url = 'http://webservices.ns.nl/ns-api-stations-v2';

        return CacheHandler::getInstance()->getCachedXMLFile($cacheName, $cacheDuration, $url, null);
    }


    /*
     *
     */
    public function getXMLContent($url, $parameters = null){
        $loginDetails = $this->NSApiConfig->getConfig();
        $this->$url = $url;

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