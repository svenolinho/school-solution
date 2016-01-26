<?php

/**
 * Description of ShowStudentsFromClass
 *
 * @author Ruben
 */
class ShowStudentsFromClass extends View {

    public function display() {

        echo "<table class=\"table table-condensed\">";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Vorname</th>";
        echo "<th>Nachname</th>";
        echo "<th>E-Mail</th>";
        echo "<th>Telefonnummer</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($this->vars['list'] as $student) { 
            $id = $student->getId();
            $urlNote = URI_STUDENTEN . "/notes-" . $student->getFirstName() . "_" . $student->getLastName();
            
            echo "<tr>";
            echo "<td>{$student->getFirstName()}</td>";
            echo "<td>{$student->getLastName()}</td>";
            echo "<td>{$student->getEmail()}</td>";
            echo "<td>{$student->getPhone()}</td>";
            echo "<td>";
            echo "<a href=\"$urlNote?id=$id\" class=\"btn btn-warning\" {$student->getFirstName()} role=\"button\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"Notizen\"><span class=\"glyphicon glyphicon-list-alt\"></span></a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    }

}
