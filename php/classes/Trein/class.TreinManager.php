<?php
class TreinManager extends Singleton{


    private $treinen;
    public function __construct() {
        $this->treinen = array();
    }

    public function addTrein(Trein $trein) {
        $this->treinen[$trein->getRitNummer()] = $trein;
    }

    public function getTreinen() {
        TreinFactory::getInstance()->loadTreinen();
        return $this->treinen;
    }

    public function getTrein($treinId) {
        if(isset($this->treinen[$treinId])) {
            return $this->treinen[$treinId];
        }
        else {
            return false;
        }
    }
}