<?php
class ViewController extends Singleton {

    public function getTreinen(){
        return TreinManager::getInstance()->getTreinen();
    }

    public function renderHomepage(){
        $homepage = new HomepageView($this->getTreinen());
        echo $homepage->getHtml();
    }

    public function renderAutoComplete(){
        $autoComplete = new AutoCompleteView();
        echo $autoComplete->getHtml();
    }

}