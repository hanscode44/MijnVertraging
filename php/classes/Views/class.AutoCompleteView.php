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

        $station = PostCookie::getInstance()->getPostCookieValue("StationActueleVertrekTijden");


        echo '<form action="index.php" method="post">';
        echo '<input type="text" name="StationActueleVertrekTijden" id="search-bar" placeholder="' . $station . '" autocomplete="off"/>';
        echo '<ul class="output" data-stations="';
        echo (Station::getInstance()->getAlleStations());
        echo '" style="display:none;"></ul>';
        echo ' <button type="submit" id="submit">Zoeken</button>';
        echo '</form>';

        return ob_get_clean();
    }

} 