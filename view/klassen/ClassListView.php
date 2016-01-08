<?php

/**
 * Description of ClassListView
 *
 * @author Ruben
 */
class ClassListView extends View {

    public function display() {

        $url = URI_KLASSEN;

        echo "<div class=\"col-md-4\">";
        echo "<div class=\"panel panel-default\">";
        echo "<div class=\"panel-heading\">";
        echo "<h4>Klassen<a data-toggle =\"schoolclass-start-new\" class=\"btn\"><span class=\"glyphicon glyphicon-plus\"></span></a></h5>";
        echo "</div>";
        echo "<form name=\"school-form\" method=\"POST\" data-action-prefix=\"$url\">";
        echo "<table class=\"table table-condensed\" data-toggle=\"schoolclass-table\">";
        echo "<tbody>";

        foreach ($this->vars['list'] as $class) {
            $id = $class->getId();
            $urlClass = URI_KLASSEN . "/show-" . $class->getName();
            $urlDelete = URI_KLASSEN . "/delete-" . $class->getName();

            echo "<tr data-toggle=\"schoolclass-row\" data-schoolclass-id=\"$id\">";
            echo "<td data-id=\"schoolclass\"><a href=\"$urlClass?id=$id\" class=\"list-group-item\">{$class->getName()}</a></td>";
            echo "<td>";
            echo "<a href=\"$urlDelete?id=$id\"  class=\"btn btn-danger\" role=\"button\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"Löschen\"><span class=\"glyphicon glyphicon-trash\"></span></a>";
            echo "</td>";
            echo "<td>";
            echo "<a class=\"btn btn-primary\" role=\"button\" data-toggle=\"schoolclass-start-edit\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"Bearbeiten\"><span class=\"glyphicon glyphicon-pencil\"></span></a>";
            echo "</td>";
            echo "<td>";
            echo "<a class=\"btn btn-warning\" role=\"button\" data-toggle=\"schoolclass-note\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"Notizen\"><span class=\"glyphicon glyphicon-list-alt\"></span></a>";
            echo "</td>";
            echo "</tr>";
        }

        echo "<tr data-schoolclass-row style=\"display:none\">";
        echo "<td><input type=\"text\" class=\"form-control\" name=\"schoolclass\">";
        echo "<input type=\"hidden\" name=\"schoolclass-id\">";
        echo "</td>";
        echo "<td><a class=\"btn btn-danger\" data-toggle=\"schoolclass-abort\"><span class=\"glyphicon glyphicon-remove\"></td>";
        echo "<td><a class=\"btn btn-primary\" data-toggle=\"schoolclass-submit\"><span class=\"glyphicon glyphicon-ok\"></span></td>";
        echo "</tr>";

        echo "</tbody>";
        echo "</table>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
        echo "<script src=\"/js/school-form.js\" type=\"text/javascript\"></script>";
    }

}
