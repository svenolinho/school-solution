<?php

/**
 * Description of StudentsListView
 *
 * @author Ruben
 */
class StudentsListView extends View {

    public function display() {

        $url = URI_STUDENTEN;

        echo "<div class=\"panel panel-default\">";
        echo "<div class =\"panel-heading\">";
        echo "<h4>Studenten<a data-toggle=\"student-start-new\" class=\"btn\"><span class=\"glyphicon glyphicon-plus\"></span></a></h5>";
        echo "</div>";
        echo "<form name=\"student-form\" method=\"POST\" data-action-prefix=\"$url\">";
        echo "<table class=\"table table-condensed\" data-toggle=\"student-table\">";

        echo "<thead>";
        echo "<tr>";
        echo "<th>Vorname</th>";
        echo "<th>Nachname</th>";
        echo "<th>E-Mail</th>";
        echo "<th>Telefonnummer</th>";
        echo "<th>Klasse</th>";
        echo "<th colspan=\"3\"></th>";
        echo "</tr>";
        echo "</thead>";

        echo "<tbody>";
        foreach ($this->vars['studentList'] as $student) {
            $id = $student->getId();
            $name = $student->getFirstName();
            $fullname = $name . "-" . $student->getLastName();
            $urlDelete = URI_STUDENTEN . "/delete-" . $fullname;
            $urlNote = URI_STUDENTEN . "/notes-" . $student->getFirstName() . "_" . $student->getLastName();
            
            echo "<tr data-toggle=\"student-row\" data-student-id=\"$id\">";
            echo "<td data-id=\"firstname\">{$student->getFirstName()}</td>";
            echo "<td data-id=\"lastname\">{$student->getLastName()}</td>";
            echo "<td data-id=\"email\">{$student->getEmail()}</td>";
            echo "<td data-id=\"phone\">{$student->getPhone()}</td>";
            echo "<td data-id=\"klasse\" data-value=\"{$student->getSchoolClassId()}\">{$student->getSchoolClassName()}</td>";
            echo "<td>";
            echo "<a href=\"$urlDelete?id=$id\"  class=\"btn btn-danger\" role=\"button\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"Löschen\"><span class=\"glyphicon glyphicon-trash\"></span></a>";
            echo "</td>";
            echo "<td>";
            echo "<a class=\"btn btn-primary\" role=\"button\" data-toggle=\"student-start-edit\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"Bearbeiten\"><span class=\"glyphicon glyphicon-pencil\"></span></a>";
            echo "</td>";
            echo "<td>";
            echo "<a href=\"$urlNote?id=$id\" class=\"btn btn-warning\" {$student->getFirstName()} role=\"button\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"Notizen\"><span class=\"glyphicon glyphicon-list-alt\"></span></a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "<tr data-student-row style=\"display:none\">";
        echo "<td><input type=\"text\" name=\"firstname\" class=\"form-control\"></td>";
        echo "<td><input type=\"text\" name=\"lastname\" class=\"form-control\"></td>";
        echo "<td><input type=\"text\" name=\"email\" class=\"form-control\"></td>";
        echo "<td><input type=\"text\" name=\"phone\" class=\"form-control\"></td>";
        echo "<td>";
        echo "<select name=\"klasse\" class=\"form-control\">";
        echo "<option>--Keine--</option>";
        foreach ($this->vars['classList'] as $klasse) {
            echo "<option value=\"" . $klasse->getId() . "\">" . $klasse->getName() . "</option>";
        }
        echo "</select>";
        echo "<input type=\"hidden\" name=\"student-id\">";
        echo "</td>";
        echo "<td><a class=\"btn btn-danger\" data-toggle=\"student-abort\"><span class=\"glyphicon glyphicon-remove\"></td>";
        echo "<td><a class=\"btn btn-primary\" data-toggle=\"student-submit\"><span class=\"glyphicon glyphicon-ok\"></span></td>";
        echo "</tr>";
        echo "</tbody>";

        echo "</table>";
        echo "</form>";
        echo "</div>";

        echo "<script src=\"/js/student-form.js\" type=\"text/javascript\"></script>";
    }

}
