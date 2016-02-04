<?php

include_once 'view/View.php';
include_once 'index.php';

class EvaluationScoreDistributionView extends EvaluationView {

    public function display() {
        parent::display();

        $classOptionList = "";
        foreach ($this->vars['classList'] as $klasse) {
            $classOptionList .= "<option value=\"" . $klasse->getId() . "\">" . $klasse->getName() . "</option>";
        }

        echo <<<EVALUATIONCLASSVIEW
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="/js/evaluation-grading.js"></script>
    <h1>Notenverteilung</h1>
    <form class="form-inline">
        <div class="form-group">
            <label for="schoolclass">Klasse</label>
            <select class="form-control" name="schoolclass">
              {$classOptionList}
            </select>
        </div>
        <div class="form-group">
            <label for="schoolclass">Runden auf</label>
            <select class="form-control" name="roundFactor">
              <option value="1">1</option>
              <option value="2">0.5</option>
              <option value="4">0.25</option>
              <option value="10">0.1</option>
            </select>
        </div>
    </form>
    <div id="chart_div"></div>
    <h1>Noten</h1>
    <table class="table" id="scoreTable">
    <thead>
        <th>Note</th>
        <th>Student</th>
        <th>Datum</th>
        <th>Fach</th>
    </thead>
    <tbody>
    </tbod>
    </table>

EVALUATIONCLASSVIEW;

    }

}
