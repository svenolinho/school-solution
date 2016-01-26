<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StudentsNotes
 *
 * @author Sven
 */
class ShowStudentsNotes extends View {

    public function display() {
        
        echo "<h3>Notizen von: <span class=\"label label-default\">{$this->vars['notes']->getFirstName()} {$this->vars['notes']->getLastName()}</span></h3>";
        
        echo "<form action=\"edit-note-\" method=\"POST\" name=\"noteForm\">";
        echo "<textarea id=\"note\" name=\"note\" rows = \"10\" cols = \"100\">";
        echo "{$this->vars['notes']->getNote()}";
        echo "</textarea><br>";
        echo "<input type=\"hidden\" name=\"student-id\" value=\"{$this->vars['notes']->getId()}\">";
        echo "<input type=\"hidden\" name=\"firstname\" value=\"{$this->vars['notes']->getFirstName()}\">";
        echo "<input type=\"hidden\" name=\"lastname\" value=\"{$this->vars['notes']->getLastName()}\">";
        echo "<input type=\"hidden\" name=\"email\" value=\"{$this->vars['notes']->getEmail()}\">";
        echo "<input type=\"hidden\" name=\"phone\" value=\"{$this->vars['notes']->getPhone()}\">";
        echo "<input type=\"hidden\" name=\"klasse\" value=\"{$this->vars['notes']->getNote()}\">";
        echo "<button type=\"submit\" type=\"button\" class=\"btn btn-primary active glyphicon glyphicon-ok\"> Speichern</button>";
        echo "</form>";
        
    }

}
