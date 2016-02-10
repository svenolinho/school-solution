<?php

include_once 'view/View.php';

class EvaluationStudentScoreView extends EvaluationView {

    public function display() {
        parent::display();

        $subjectsInput = "";
        foreach ($this->vars['subjectList'] as $subject) {
            $subjectsInput .= "<label class=\"checkbox-inline\"><input type=\"checkbox\" name=\"subject\" value=\"" . $subject->getId() . "\"\>" . $subject->getSubjectName(). "</label>";
        }

        $studentsOptionHtml = "";
        foreach ($this->vars['studentList'] as $student) {
            $studentsOptionHtml .="<option value=\"{$student->getId()}\">{$student->getLastName()} {$student->getFirstName()}</option>)";
        }

        echo <<<EVALUATIONCLASSVIEW
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="/js/evaluation-student-average.js"></script>
    <h1>Noten Student</h1>
    <form>
        <div class="form-group">
            <label class="control-label" for="schoolClass">Schüler</label>
            <select class="form-control" name="studentId" id="studentId">
                $studentsOptionHtml
            </select>
        </div>
        <div class="form-group">
            {$subjectsInput}
        </div>
    </form>
    <div id="chart_div"></div>
    <h1>Alle Noten</h1>
    <table class="table" id="scoreTable">
    <thead>
        <th>Note</th>
        <th>Datum</th>
        <th>Fach</th>
    </thead>
    <tbody>
    </tbod>
    </table>

EVALUATIONCLASSVIEW;

    }

}
