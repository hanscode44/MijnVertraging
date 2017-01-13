<?php

class HomepageView extends GeneralView
{

    public function __construct($treinen)
    {
        parent::__construct($treinen);
    }

    public function getHtml()
    {
        ob_start();

        echo '<div class="introductie">';
        $station = PostCookie::getInstance()->getPostCookieValue("StationActueleVertrekTijden");
        if (isset($station)) {
            echo "Je bekijkt de actuele vertrektijden van het station " . $station;
            echo '</div>';
            echo $this->getVertrektijden();
        } else {
            echo "Er is nog geen station gekozen. Zoek in de balk bovenaan de pagina naar het gewenste station";
            echo $this->getVertrektijden();
        }

        return ob_get_clean();

    }

    public function getVertrektijden()
    {
        ob_start();
        echo '<div id="vertrektijden">';

        /** @var Trein $trein */
        foreach ($this->getTreinen() as $trein) {
            echo '<div class="treinRit">';
            echo '<div class="treinRitInfobar">';
            echo '<div class="vertrekTijdInfo">';
            if ($trein->heeftWijziging() == true) {
                echo '<span class="entypo-attention red"></span>';
            }
            echo '<span class="vertrekTijd">' . $trein->getVertrekTijd() . '</span>';
            if ($trein->getVertrekVertragingTekst() != null) {
                echo '<span class="vertrekVertraging red">' . $trein->getVertrekVertragingTekst() . '</span>';
            }
            echo '</div>';
            echo '<span class="eindBestemming ' .
                ($trein->rijdtTrein() == false ? "red strikeThrough" : "") .
                '">' .
                $trein->getEindBestemming() .
                '</span>';
            if ($trein->getOpmerkingen() != null) {
                echo '<span class="opmerking red"> ' . current($trein->getOpmerkingen()) . '</span>';
            }
            echo '<span class="arrow arrow-down"></span>';
            echo '</div>';
            echo '<div class="treinRitDetails ">';
            if ($trein->getRouteTekst() != "") {
                echo '<span class="entypo-map routeTekst">Routetekst: ' . $trein->getRouteTekst() . '</span><br />';
            }
            echo '<span class="entypo-doc-text ritNummer">Ritnummer: ' . $trein->getRitNummer() . '</span><br />';
            echo '<span class="entypo-address vertrekSpoor ' .
                ($trein->getVertrekSpoorGewijzigd() == "true" ? "red" : "") .
                '">Spoor: ' .
                $trein->getVertrekSpoor() .
                '</span><br />';

            if ($trein->getReisTip() != "") {
                echo '<span class="entypo-info-circled entypo-reisTip">Reistip: ' . $trein->getReisTip() . '</span>';
            }

            if ($trein->getOpmerkingen() != null) {
                foreach ($trein->getOpmerkingen() as $opmerking) {
                    echo '<span class="entypo-attention opmerking red"> ' . $opmerking . '</span>';
                }
            }
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';

        return ob_get_clean();

    }

} 