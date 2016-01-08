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
            echo "<tr>";
            echo "<td>{$student->getFirstName()}</td>";
            echo "<td>{$student->getLastName()}</td>";
            echo "<td>{$student->getEmail()}</td>";
            echo "<td>{$student->getPhone()}</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    }

}
