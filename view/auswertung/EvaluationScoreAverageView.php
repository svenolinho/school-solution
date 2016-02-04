<?php

include_once 'view/View.php';
include_once 'index.php';

class EvaluationScoreAverageView extends EvaluationView {

    public function display() {
        parent::display();

        $classOptionList = "";
        foreach ($this->vars['classList'] as $klasse) {
            $classOptionList .= "<option value=\"" . $klasse->getId() . "\">" . $klasse->getName() . "</option>";
        }

        echo <<<EVALUATIONCLASSVIEW
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="/js/evaluation-average.js"></script>
    <h1>Entwicklung Notendurchschnitt</h1>
    <form class="form-inline">
        <div class="form-group">
            <label for="schoolclass">Klasse</label>
            <select class="form-control" name="schoolclass">
              {$classOptionList}
            </select>
        </div>
    </form>
    <div id="chart_div"></div>

EVALUATIONCLASSVIEW;

    }

}
