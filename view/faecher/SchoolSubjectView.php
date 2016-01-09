<?php

class SchoolSubjectView extends View {

    public function display() {

        $url = URI_FAECHER;

        echo "<div class=\"col-md-4\">";
        echo "<div class=\"panel panel-default\">";
        echo "<div class=\"panel-heading\">";
        echo "<h4>F&auml;cher<a data-toggle =\"schoolsubject-start-new\" class=\"btn\"><span class=\"glyphicon glyphicon-plus\"></span></a></h5>";
        echo "</div>";
        echo "<form name=\"school-form\" method=\"POST\" data-action-prefix=\"$url\">";
        echo "<table class=\"table table-condensed\" data-toggle=\"schoolsubject-table\">";
        echo "<tbody>";

        foreach ($this->vars['list'] as $subject) {
            $id = $subject->getId();
            $urlClass = URI_FAECHER . "/show-" . $subject->getSubjectName();
            $urlDelete = URI_FAECHER . "/delete-" . $subject->getSubjectName();

            echo "<tr data-toggle=\"schoolsubject-row\" data-schoolsubject-id=\"$id\">";
            echo "<td data-id=\"schoolsubject\"><a href=\"$urlClass?id=$id\" class=\"list-group-item\">{$subject->getSubjectName()}</a></td>";
            echo "<td>";
            echo "<a href=\"$urlDelete?id=$id\"  class=\"btn btn-danger\" role=\"button\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"Löschen\"><span class=\"glyphicon glyphicon-trash\"></span></a>";
            echo "</td>";
            echo "<td>";
            echo "<a class=\"btn btn-primary\" role=\"button\" data-toggle=\"schoolsubject-start-edit\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"Bearbeiten\"><span class=\"glyphicon glyphicon-pencil\"></span></a>";
            echo "</td>";
            echo "</tr>";
        }

        echo "<tr data-schoolsubject-row style=\"display:none\">";
        echo "<td><input type=\"text\" class=\"form-control\" name=\"schoolsubject\">";
        echo "<input type=\"hidden\" name=\"schoolsubject-id\">";
        echo "</td>";
        echo "<td><a class=\"btn btn-danger\" data-toggle=\"schoolsubject-abort\"><span class=\"glyphicon glyphicon-remove\"></span></a></td>";
        echo "<td><a class=\"btn btn-primary\" data-toggle=\"schoolsubject-submit\"><span class=\"glyphicon glyphicon-ok\"></span></a></td>";
        echo "</tr>";

        echo "</tbody>";
        echo "</table>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
        echo "<script src=\"/js/schoolsubject-form.js\" type=\"text/javascript\"></script>";
    }

}
