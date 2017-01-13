<?php

class TreinManager extends Singleton
{
    private $treinen;

    public function __construct()
    {
        $this->treinen = array();
    }

    /**
     * @param Trein $trein
     */
    public function addTrein(Trein $trein)
    {
        $this->treinen[$trein->getRitNummer()] = $trein;
    }

    /**
     * @return array
     */
    public function getTreinen()
    {
        TreinFactory::getInstance()->loadTreinen();

        return $this->treinen;
    }

    /**
     * @param $treinId
     *
     * @return bool|mixed
     */
    public function getTrein($treinId)
    {
        if (isset($this->treinen[$treinId])) {
            return $this->treinen[$treinId];
        } else {
            return false;
        }
    }
}