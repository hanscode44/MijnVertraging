<?php
class ViewController {

    public static function getInstance(){
        static $instance = null;
        if (null === $instance) {
            $instance = new ViewController();
        }
        return $instance;
    }

    public function getTreinen(){
        return TreinManager::getInstance()->getTreinen();
    }

    public function renderHomepage(){
        $homepage = new HomepageView($this->getTreinen());
        echo $homepage->getHtml();
    }

}