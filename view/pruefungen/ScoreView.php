<?php

include_once 'view/View.php';

class ScoreView extends View
{

    public function display()
    {

        $scoresListHtml = "";
        foreach ($this->vars['exam']->getStudentScores() as $score) {
            $scoresListHtml.= "<td>{$score->getStudent()->getFirstName()} {$score->getStudent()->getLastName()}</td>";
            $anwesend = ($score->getPresent() ? 'Ja':'Nein');
            $scoresListHtml.= "<td>{$anwesend}</td>";
            $scoresListHtml.= "<td>{$score->getScore()}</td>";
        }

        echo <<<OVERVIEW
        <h3>{$this->vars['exam']->getSubjectName()} Pr&uuml;fung vom {$this->vars['exam']->getDate()}</h3>
        <div class="row">
            <div class="col-md-2">Datum</div>
            <div class="col-md-10">{$this->vars['exam']->getDate()}</div>
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
            <h4>Resultate<a class="btn"><span class="glyphicon glyphicon-plus"></span></a>
        </div>
        <div class="panel-body">
            <table class="table table-condensed" data-toggle="schoolexam-table">
            <thead>
                <tr>
                    <th>Schüler</th>
                    <th>Anwesend</th>
                    <th>Punktzahl</th>
                    <th>Note</th>
                </tr>
            </head>
            <tr>
                $scoresListHtml
            </tr>
            </table>
        </div>
OVERVIEW;

    }

}
