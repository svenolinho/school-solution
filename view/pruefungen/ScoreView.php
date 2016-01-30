<?php

include_once 'view/View.php';

class ScoreView extends View
{

    public function display()
    {
        $scoresListHtml = "";
        foreach ($this->vars['exam']->getStudentScores() as $score) {
            $scoresListHtml.= "<tr data-toggle=\"studentscore-row\" data-studentscore-id=\"{$score->getId()}\">";
            $scoresListHtml.= "<td data-id=\"student\" data-value=\"{$score->getStudent()->getId()}\">{$score->getStudent()->getLastName()} {$score->getStudent()->getFirstName()}</td>";
            $present = ($score->getPresent() ? 'Ja':'Nein');
            $presentValue = ($score->getPresent() ? '1':'0');
            $scoresListHtml.= "<td data-id=\"present\" data-value=\"{$presentValue}\">{$present}</td>";
            $scoresListHtml.= "<td data-id=\"score\">{$score->getScore()}</td>";
            $scoresListHtml.= "<td>TODO</td>";

            $urlDelete = URI_PRUEFUNGEN . "/delete-score" . $score->getId();
            $scoresListHtml.= "<td><a href=\"$urlDelete?id={$score->getId()}\" class=\"btn btn-danger\" role=\"button\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"Löschen\"><span class=\"glyphicon glyphicon-trash\"></span></a></td>";
            $scoresListHtml.= "<td><a class=\"btn btn-primary\" role=\"button\" data-toggle=\"modal\" data-target=\"#editScore\" data-score-start-edit data-toggle=\"tooltip\" data-placement=\"right\" title=\"Bearbeiten\"><span class=\"glyphicon glyphicon-pencil\"></span></a></td>";
            $scoresListHtml.= "</tr>";
        }

        $date = new DateTime($this->vars['exam']->getDate());
        echo <<<OVERVIEW
        <h3>{$this->vars['exam']->getSubjectName()} Pr&uuml;fung vom {$date->format("d.m.Y")}</h3>
        <div class="row">
            <div class="col-md-2">Datum</div>
            <div class="col-md-10">{$date->format("d.m.Y")}</div>
        </div>
        <div class="row">
            <div class="col-md-2">Fach</div>
            <div class="col-md-10">{$this->vars['exam']->getSubjectName()}</div>
        </div>
        <div class="row">
            <div class="col-md-2">Notenschlüssel</div>
            <div class="col-md-10">{$this->vars['exam']->getClef()}</div>
        </div>
        <div class="row">
            <div class="col-md-2">Maximale Punktzahl</div>
            <div class="col-md-10">{$this->vars['exam']->getMaxScore()}</div>
        </div>
        <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Resultate<a data-toggle="modal" data-target="#newScore" class="btn"><span class="glyphicon glyphicon-plus"></span></a>
        </div>
        <div class="panel-body">
            <table class="table table-condensed" data-toggle="schoolexam-table">
            <thead>
                <tr>
                    <th>Schüler</th>
                    <th>Anwesend</th>
                    <th>Punktzahl</th>
                    <th>Note</th>
                    <th colspan="2"></th>
                </tr>
            </head>
            $scoresListHtml
            </table>
        </div>
OVERVIEW;

        $url = URI_PRUEFUNGEN;

        $studentsOptionHtml ="";
        foreach($this->vars['students'] as $student) {
            $studentsOptionHtml .="<option value=\"{$student->getId()}\">{$student->getLastName()} {$student->getFirstName()}</option>)";
        }

        echo <<<NEWSCORE
        <div class="modal fade" id="newScore" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <form action="$url/new-score" method="post" name="newScoreForm">
                <input type="hidden" name="examId" value="{$this->vars['exam']->getId()}"/>
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Neue Pr&uuml;fung</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="schoolClass">Schüler</label>
                            <select class="form-control" name="studentId" id="studentId">
                                $studentsOptionHtml
                            </select>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="present" id="present" value="true"> Anwesend
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="maxScore">Erreichte Punktzahl</label>
                            <input type="text" name="score" id="score" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                      <a class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></a>
                      <a class="btn btn-success" onClick="javascript:document.newScoreForm.submit();"><span class="glyphicon glyphicon-ok"></span></a>
                    </div>
                  </div>
                </div>
            </form>
      </div>
NEWSCORE;

        echo "<script src=\"/js/studentscore-form.js\" type=\"text/javascript\"></script>";

        echo <<<EDITSCORE
        <div class="modal fade" id="editScore" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <form action="$url/edit-score" method="post" name="editScoreForm">
                <input type="hidden" name="scoreId" />
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Neue Pr&uuml;fung</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="schoolClass">Schüler</label>
                            <select class="form-control" name="studentId" id="studentId">
                                $studentsOptionHtml
                            </select>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="present" id="present" value="true"> Anwesend
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="maxScore">Erreichte Punktzahl</label>
                            <input type="text" name="score" id="score" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                      <a class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></a>
                      <a class="btn btn-success" onClick="javascript:document.editScoreForm.submit();"><span class="glyphicon glyphicon-ok"></span></a>
                    </div>
                  </div>
                </div>
            </form>
      </div>
EDITSCORE;


    }

}
