<?php

class Trein
{
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
        foreach ($trein as $key => $value) {
            if (isset($value) || $value || $value != '') {
                $this->$key = $value;
            } else {
                $this->$key = false;
            }
        }
    }

    public function getEindBestemming()
    {
        return $this->eindBestemming;
    }

    public function getOpmerkingen()
    {
        return $this->opmerkingen;
    }

    public function getReisTip()
    {
        return $this->reisTip;
    }

    public function getRitNummer()
    {
        return $this->ritNummer;
    }

    public function getRouteTekst()
    {
        return $this->routeTekst;
    }

    public function getTreinSoort()
    {
        return $this->treinSoort;
    }

    public function getVertrekSpoor()
    {
        return $this->vertrekSpoor;
    }

    public function getVertrekSpoorGewijzigd()
    {
        return $this->vertrekSpoorGewijzigd;
    }

    public function getVertrekTijd()
    {
        $atomFormattedDate = $this->vertrekTijd;
        $phpTimestamp = strtotime(substr($atomFormattedDate, 0, 10) . ' ' . substr($atomFormattedDate, 11, 8));
        $vertrekTijd = date('H:i', $phpTimestamp);

        return $vertrekTijd;
    }

    public function getVertrekVertragingTekst()
    {
        return $this->vertrekVertragingTekst;
    }

    public function heeftWijziging()
    {
        if ($this->vertrekVertragingTekst != null ||
            $this->vertrekSpoorGewijzigd == "true" ||
            $this->opmerkingen != null
        ) {
            return true;
        } else {
            return false;
        }
    }

    public function rijdtTrein()
    {
        if ($this->opmerkingen != null && current($this->opmerkingen) == "Rijdt vandaag niet") {
            return false;
        } else {
            return true;
        }
    }
}