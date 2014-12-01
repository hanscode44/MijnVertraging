<?php
class TreinFactory {

    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new TreinFactory();
        }
        return $instance;
    }

    public function loadTreinen() {
        $XMLInput = APIHandler::getInstance()->getVertrekTijden("Rotterdam");
        $xml = new SimpleXMLElement($XMLInput);

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