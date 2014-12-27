<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 6-12-2014
 * Time: 02:33
 */

class Station extends Singleton{

    public function getAlleStations(){

        $XMLInput = APIHandler::getInstance()->getStations();
        $xml = new SimpleXMLElement(file_get_contents($XMLInput));

        $array = array();

        foreach ($xml->Station as $xmlStation) {
            if($xmlStation->Land == "NL"){
                $stationNaamLang = (string)$xmlStation->Namen->Lang;
                $array[] = $stationNaamLang;
                if($xmlStation->Synoniemen){
                    foreach ($xmlStation->Synoniemen->Synoniem as $xmlStationSynoniem){
                        $stationSynoniemen = (string)$xmlStationSynoniem;
                        $array[] = $stationSynoniemen;
                    }

                }



            }
        }

        sort($array);
        $array = json_encode($array);
        $array = htmlspecialchars($array, ENT_QUOTES );

//        file_put_contents("cache_file", serialize($array));
//        unserialize(file_get_contents("cache_file"));


        return $array;

    }
} 