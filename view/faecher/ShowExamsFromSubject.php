<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ShowExamsFromSubject
 *
 * @author Sven
 */
class ShowExamsFromSubject extends View {
    
        public function display() {

        echo "<table class=\"table table-condensed\">";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Prüfungsdatum</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($this->vars['list'] as $exam) { 
            $id = $exam->getId();
//            $urlNote = URI_FAECHER . "/notes-" . $student->getFirstName() . "_" . $student->getLastName();
            
            echo "<tr>";
            echo "<td>{$exam->getDate()}</td>";
//            echo "<td>";
//            echo "<a href=\"$urlNote?id=$id\" class=\"btn btn-warning\" {$student->getFirstName()} role=\"button\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"Notizen\"><span class=\"glyphicon glyphicon-list-alt\"></span></a>";
//            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    }
}
