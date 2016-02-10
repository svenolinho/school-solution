<?php

include_once 'view/View.php';
include_once 'index.php';

class EvaluationView extends View {

    public function display() {
        $baseUrl = URI_AUSWERTUNG;

        echo <<<EVALUATIONCHOOSER
    <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="evaluationMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Auswertung <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="evaluationMenu">
            <li class="dropdown-header">Klassen</li>
            <li><a href="$baseUrl/distribution">Notenverteilung/Noten</a></li>
            <li><a href="$baseUrl/average">Entwicklung Notendurchschnitt</a></li>
            <li><a href="$baseUrl/comparison">Vergleich</a></li>
            <li role="separator" class="divider"></li>
            <li class="dropdown-header">Studenten</li>
            <li><a href="$baseUrl/studentScores">Notendurchschnitt/Noten</a></li>
        </ul>
    </div>

EVALUATIONCHOOSER;

    }

}
