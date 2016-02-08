<?php

include_once 'view/View.php';
include_once 'index.php';

class EvaluationScoreComparisonView extends EvaluationView {

    public function display() {
        parent::display();

        $classesInput = "";
        foreach ($this->vars['classList'] as $klasse) {
            $classesInput .= "<label class=\"checkbox-inline\"><input type=\"checkbox\" name=\"class\" value=\"" . $klasse->getId() . "\"\>" . $klasse->getName() . "</label>";
        }

        $subjectsInput = "";
        foreach ($this->vars['subjectList'] as $subject) {
            $subjectsInput .= "<label class=\"checkbox-inline\"><input type=\"checkbox\" name=\"subject\" value=\"" . $subject->getId() . "\"\>" . $subject->getSubjectName(). "</label>";
        }

        echo <<<EVALUATIONCLASSVIEW
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="/js/evaluation-comparison.js"></script>
    <h1>Vergleich</h1>
    <p>Der "Notenschnitt gesamt" ist der Schnitt über alle Noten der Klasse im Fach und nicht der Schnitt der Notenschnitte.</p>
    <form>
        <div class="form-group">
            {$classesInput}
        </div>
        <div class="form-group">
            {$subjectsInput}
        </div>
    </form>
    <div id="chart_div"></div>

EVALUATIONCLASSVIEW;

    }

}
