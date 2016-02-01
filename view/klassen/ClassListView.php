<?php

/**
 * Description of ClassListView
 *
 * @author Ruben
 */
class ClassListView extends View {

    public function display() {

        $this->displayErrors();
        $url = URI_KLASSEN;
        echo "<div class=\"col-md-6\">";
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
            $urlNote = URI_KLASSEN . "/notes-" . $class->getName();

            echo "<tr data-toggle=\"schoolclass-row\" data-schoolclass-id=\"$id\">";
            echo "<td data-id=\"schoolclass\"><a href=\"$urlClass?id=$id\" class=\"list-group-item\">{$class->getName()}</a></td>";
            echo "<td>";
            echo "<a href=\"$urlDelete?id=$id\"  class=\"btn btn-danger\" role=\"button\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"Löschen\"><span class=\"glyphicon glyphicon-trash\"></span></a>";
            echo "</td>";
            echo "<td>";
            echo "<a class=\"btn btn-primary\" role=\"button\" data-toggle=\"schoolclass-start-edit\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"Bearbeiten\"><span class=\"glyphicon glyphicon-pencil\"></span></a>";
            echo "</td>";
            echo "<td>";
            echo "<a href=\"$urlNote?id=$id\" class=\"btn btn-warning\" {$class->getName()} role=\"button\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"Notizen\"><span class=\"glyphicon glyphicon-list-alt\"></span></a>";
            echo "</td>";
            echo "</tr>";
        }

        echo "<tr data-schoolclass-row style=\"display:none\">";
        echo "<td><div class=\"form-group\"><input type=\"text\" class=\"form-control\" name=\"schoolclass\"></div>";
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
        echo "<script src=\"/js/schoolclass-form.js\" type=\"text/javascript\"></script>";
    }

    public function displayErrors()
    {
        if (array_key_exists('mysqlResult',$this->vars)) {
            switch ($this->vars['mysqlResult']) {
                case MySqlResult::ClassDeleteStudentError:
                    echo "<div class=\"alert alert-danger\" role=\"alert\">Diese Klasse kann nicht gelöscht werden. Bitte entfernen Sie zuerst alle Schüler aus der Klasse und wiederholen Sie den Vorgang.</div>";
                    break;
                case MySqlResult::ClassDeleteExamsError:
                    echo "<div class=\"alert alert-danger\" role=\"alert\">Diese Klasse kann nicht gelöscht werden. Bitte entfernen Sie zuerst alle Prüfungen dieser Klasse und wiederholen Sie den Vorgang.</div>";
                    break;
            }
        }
    }

}
