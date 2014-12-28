<?php

class Trein {
    private $ritNummer;
    private $vertrekTijd;
    private $vertrekVertragingTekst;
    private $eindBestemming;
    private $treinSoort;
    private $routeTekst;
    private $vertrekSpoor;
    private $vertrekSpoorGewijzigd;
    private $reisTip;
    private $opmerkingen;


    public function __construct($trein)
    {
        foreach($trein as $key => $value) {
            if(isset($value) || $value || $value != '') {
                $this->$key = $value;
            }
            else {
                $this->$key = false;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getEindBestemming()
    {
        return $this->eindBestemming;
    }

    /**
     * @return mixed
     */
    public function getOpmerkingen()
    {
        return $this->opmerkingen;
    }



    /**
     * @return mixed
     */
    public function getReisTip()
    {
        return $this->reisTip;
    }


    /**
     * @return mixed
     */
    public function getRitNummer()
    {
        return $this->ritNummer;
    }

    /**
     * @return mixed
     */
    public function getRouteTekst()
    {
        return $this->routeTekst;
    }

    /**
     * @return mixed
     */
    public function getTreinSoort()
    {
        return $this->treinSoort;
    }

    /**
     * @return mixed
     */
    public function getVertrekSpoor()
    {
        return $this->vertrekSpoor;
    }

    /**
     * @return mixed
     */
    public function getVertrekSpoorGewijzigd()
    {
        return $this->vertrekSpoorGewijzigd;
    }

    /**
     * @return mixed
     */
    public function getVertrekTijd()
    {
        $atomFormattedDate = $this->vertrekTijd;
        $phpTimestamp = strtotime(substr($atomFormattedDate, 0, 10).' '.substr($atomFormattedDate, 11, 8));
        $vertrekTijd = date('H:i', $phpTimestamp);
        return $vertrekTijd;
    }

    /**
     * @return mixed
     */
    public function getVertrekVertragingTekst()
    {
        return $this->vertrekVertragingTekst;
    }
}