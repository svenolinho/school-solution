<?php

include_once 'view/View.php';

class ExamView extends View {

    public function display() {

        $url = URI_PRUEFUNGEN;

        echo "<div class=\"col-md-10\">";
        echo "<div class=\"panel panel-default\">";
        echo "<div class=\"panel-heading\">";
        echo "<h4>Pr&uuml;fungen<a data-toggle=\"modal\" data-target=\"#newExam\" class=\"btn\"><span class=\"glyphicon glyphicon-plus\"></span></a></h5>";
        echo "</div>";
        echo "<table class=\"table table-condensed\" data-toggle=\"schoolexam-table\">";
        echo <<<THEAD
                <thead>
                    <tr>
                        <th>Datum</th>
                        <th>Fach</th>
                        <th>Klasse</th>
                    </tr>
                </head>
THEAD;
        echo "<tbody>";
        foreach ($this->vars['list'] as $exam) {
            $id = $exam->getId();
            $urlClass = URI_PRUEFUNGEN . "/show-" . $exam->getId();
            $urlDelete = URI_PRUEFUNGEN . "/delete-" . $exam->getId();

            echo "<tr data-toggle=\"schoolexam-row\" data-schoolexam-id=\"$id\">";
            echo "<td data-id=\"schoolexam\"><a href=\"$urlClass?id=$id\" class=\"list-group-item\">{$exam->getDate()}</a></td>";
            echo "<td data-id=\"schoolexam\"><a href=\"$urlClass?id=$id\" class=\"list-group-item\">{$exam->getSubjectName()}</a></td>";
            echo "<td data-id=\"schoolexam\"><a href=\"$urlClass?id=$id\" class=\"list-group-item\">{$exam->getSchoolClassName()}</a></td>";
            echo "<td>";
            echo "<a href=\"$urlDelete?id=$id\"  class=\"btn btn-danger\" role=\"button\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"Löschen\"><span class=\"glyphicon glyphicon-trash\"></span></a>";
            echo "</td>";
            echo "<td>";
            echo "<a class=\"btn btn-primary\" role=\"button\" data-toggle=\"schoolexam-start-edit\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"Bearbeiten\"><span class=\"glyphicon glyphicon-pencil\"></span></a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
        echo "</div>";
        echo "<script src=\"/js/schoolexam-form.js\" type=\"text/javascript\"></script>";
        
        $schoolClassOptionHtml = "";
        foreach ($this->vars['schoolClassList'] as $class){
           $schoolClassOptionHtml.="<option value=\"{$class->getId()}\">{$class->getName()}</option>)";         
        }
        
        $schoolSubjectOptionHtml = "";
        foreach ($this->vars['schoolSubjectList'] as $subject){
           $schoolSubjectOptionHtml.="<option value=\"{$subject->getId()}\">{$subject->getSubjectName()}</option>)";         
        }
        
        echo <<<EXAMFORM
        <div class="modal fade" id="newExam" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <form action="$url/new" method="post" name="newExamForm">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Neue Pr&uuml;fung</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="schoolClass">Klasse</label>
                            <select class="form-control" name="schoolClass" id="schoolClass">
                                $schoolClassOptionHtml
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subject">Fach</label>
                            <select class="form-control" name="subject" id="subject">
                                $schoolSubjectOptionHtml
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="date">Datum</label>
                            <input type="date" name="date" id="date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="clef">Notenschl&uuml;ssel</label>
                            <input type="text" name="clef" id="clef" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="maxScore">Maximale Punktzahl</label>
                            <input type="text" name="maxScore" id="maxScore" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                      <a class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></a>
                      <a class="btn btn-success" onClick="javascript:document.newExamForm.submit();"><span class="glyphicon glyphicon-ok"></span></a>
                    </div>
                  </div>
                </div>
            </form>
      </div>
EXAMFORM;
    }

}
