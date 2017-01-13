<?php

class GeneralView
{
    protected $treinen;

    public function __construct($treinen)
    {
        $this->treinen = $treinen;
    }

    /**
     * Getter for all treinen linked to a view
     * @return mixed returns all treinen linked to a view
     */
    public function getTreinen()
    {
        return $this->treinen;
    }
} 