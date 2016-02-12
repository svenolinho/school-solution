<?php

include_once 'view/View.php';
include_once 'index.php';

class EvaluationStudentComparisonView extends EvaluationView {

    public function display() {
        parent::display();

        $classOptionList = "";
        foreach ($this->vars['classList'] as $klasse) {
            $classOptionList .= "<option value=\"" . $klasse->getId() . "\">" . $klasse->getName() . "</option>";
        }

        echo <<<EVALUATIONCLASSVIEW
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="/js/evaluation-student-comparison.js"></script>
    <h1>Vergleich Studenten</h1>
    <form class="form-inline">
        <div class="form-group">
            <label for="schoolclass">Klasse</label>
            <select class="form-control" name="schoolclass">
              {$classOptionList}
            </select>
        </div>
        <div class="form-group">
            <label class="checkbox"><input type="checkbox" name="toggleAll" value=""\> Alle selektieren</label>
        </div>
        <div class="form-group" id="studentInputs">
        </div>
    </form>
    <div id="chart_div"></div>

EVALUATIONCLASSVIEW;

    }

}
