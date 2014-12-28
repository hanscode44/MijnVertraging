<?php
class TreinFactory extends Singleton {

    public function loadTreinen() {
        $station = PostCookie::getInstance()->getPostCookieValue("StationActueleVertrekTijden");
        if(isset($station)){
        $XMLInput = APIHandler::getInstance()->getVertrekTijden($station);
        /*
         * Check for XML-file. If it's a cache-file, use file_get_contents
         */
        if (@simplexml_load_file($XMLInput))
        {
            $xml = new SimpleXMLElement(file_get_contents($XMLInput));
        }
        else
        {
            $xml = new SimpleXMLElement($XMLInput);
        }

        foreach ($xml->VertrekkendeTrein as $xmlVertrekkendeTrein)
        {
            $ritNummer = (string)$xmlVertrekkendeTrein->RitNummer;
            $vertrekTijd = (string)($xmlVertrekkendeTrein->VertrekTijd);
            $vertrekVertragingTekst = (string)$xmlVertrekkendeTrein->VertrekVertragingTekst;
            $eindBestemming = (string)$xmlVertrekkendeTrein->EindBestemming;
            $treinSoort = (string)$xmlVertrekkendeTrein->TreinSoort;
            $vertrekSpoor = (string)$xmlVertrekkendeTrein->VertrekSpoor;
            $vertrekSpoorGewijzigd = (string)($xmlVertrekkendeTrein->VertrekSpoor['wijziging']);
            $routeTekst = (string)$xmlVertrekkendeTrein->RouteTekst;
            $reisTip = (string)$xmlVertrekkendeTrein->ReisTip;
            $this->loadTrein($ritNummer, $vertrekTijd, $vertrekVertragingTekst, $eindBestemming, $treinSoort, $routeTekst, $vertrekSpoor, $vertrekSpoorGewijzigd, $reisTip);
        }
        return $xml;
        }
        else{

        }
    }

    public function loadTrein($ritNummer, $vertrekTijd, $vertrekVertragingTekst, $eindBestemming, $treinSoort, $routeTekst, $vertrekSpoor, $vertrekSpoorGewijzigd, $reisTip){
        $trein = new Trein(array(
            'ritNummer' => $ritNummer,
            'vertrekTijd' => $vertrekTijd,
            'vertrekVertragingTekst' => $vertrekVertragingTekst,
            'eindBestemming' => $eindBestemming,
            'treinSoort' => $treinSoort,
            'routeTekst' => $routeTekst,
            'vertrekSpoor' => $vertrekSpoor,
            'vertrekSpoorGewijzigd' => $vertrekSpoorGewijzigd,
            'reisTip' => $reisTip
        ));

        TreinManager::getInstance()->addTrein($trein);
    }
    public function addTrein($trein){
        $trein = new Trein($trein);
        TreinManager::getInstance()->addTrein($trein);

        return $trein->getTreinID();
    }

} 