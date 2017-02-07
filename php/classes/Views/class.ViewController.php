<?php

class ViewController extends Singleton
{

    public function getTreinen()
    {
        return TreinManager::getInstance()->getTreinen();
    }

    public function renderHomepage()
    {
        /** @var HomepageView $homepage */
        $homepage = new HomepageView($this->getTreinen());
        echo $homepage->getHtml();

    }

    public function renderAutoComplete()
    {
        /** @var AutoCompleteView $autoComplete */
        $autoComplete = new AutoCompleteView();
        echo $autoComplete->getHtml();
    }

}