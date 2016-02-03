<?php

include_once 'view/View.php';
include_once 'index.php';

class EvaluationView extends View {

    public function display() {
        $classOptionList = "";
        foreach ($this->vars['classList'] as $klasse) {
            $classOptionList .= "<option value=\"" . $klasse->getId() . "\">" . $klasse->getName() . "</option>";
        }

        echo <<<EVALUATIONCLASSVIEW
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="/js/evaluation-grading.js"></script>
    <h1>Notenverteilung</h1>
    <div class="form-group">
        <select class="form-control" name="schoolclass">
          {$classOptionList}
        </select>
    </div>
    <div id="chart_div"></div>

EVALUATIONCLASSVIEW;

    }

}
