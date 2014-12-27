<?php

class APIHandler {
    private $NSApiConfig;

    function __construct() {
        $this->NSApiConfig = new NSApiConfig();
    }


    public static function getInstance() {
        static $instance = null;
        if (null === $instance) {
            $instance = new APIHandler();
        }
        return $instance;
    }

    public function getVertrekTijden($station) {

        $url = 'http://webservices.ns.nl/ns-api-avt';
        $parameters = array(
            'station' => $station
        );
        $cacheName = "vertrekTijden" . implode("", $parameters);
        $cacheDuration = 60; // 1 minuut

        return $this->getCachedXMLFile($cacheName, $cacheDuration, $url, $parameters);
    }

    public function getStations(){
        $cacheName = 'stations';
        $cacheDuration = 60 * 60 * 24; // 24 uur
        $url = 'http://webservices.ns.nl/ns-api-stations-v2';

        return $this->getCachedXMLFile($cacheName, $cacheDuration, $url, null);;
    }

    public function getCachedXMLFile($cacheName, $cacheDuration, $url, $parameters = null){
        $this->$cacheDuration = $cacheDuration;
        $cacheFolder = "cache/";
        $cacheFile = $cacheFolder . $cacheName . '.cache';
        $modifyFileTime = filemtime($cacheFile) + $cacheDuration;
        if(!file_exists($cacheFile) || $modifyFileTime < time()) {
            $contents = $this->getXMLContent($url, $parameters);
            file_put_contents($cacheFile, $contents);
            debugToConsole($cacheFile . " toegevoegd aan cache voor " . $cacheDuration .  " seconden.");
        }
        else{
            debugToConsole("Cachebestand (" . $cacheName . ") geladen. Aanmaakdatum: " . date("d-m-Y H:i:s",filemtime($cacheFile)));
        }
        return $cacheFile;
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