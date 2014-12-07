<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 6-12-2014
 * Time: 23:20
 */

class AutoCompleteView {

    public function getHtml(){
        ob_start();

        $data = Station::getInstance()->getAlleStations();

        echo '<input type="text" id="search-bar" autocomplete="off"/>';
        echo '<ul class="output" data-stations="';
        echo (Station::getInstance()->getAlleStations());
        echo '" style="display:none;"></ul>';
        echo ' <button type="submit" id="submit">Zoeken</button>';

        return ob_get_clean();
    }

} 