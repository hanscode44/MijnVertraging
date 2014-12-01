<?php
class TreinManager {


    private $treinen;
    private function __construct() {
        $this->treinen = array();
    }

    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new TreinManager();
        }
        return $instance;
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