<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ShowExamNotes
 *
 * @author Sven
 */
class ShowExamNotes extends View {

    public function display() {

        echo "<h3>Notizen von: <span class=\"label label-default\">{$this->vars['notes']->getDate()}</span></h3>";

        echo "<form action=\"edit-note-\" method=\"POST\" name=\"noteForm\">";
        echo "<textarea id=\"note\" name=\"note\" rows = \"10\" cols = \"100\">";
        echo "{$this->vars['notes']->getNote()}";
        echo "</textarea><br>";
        echo "<input type=\"hidden\" name=\"schoolsubject-id\" value=\"{$this->vars['notes']->getId()}\">";
        echo "<input type=\"hidden\" name=\"schoolsubject\" value=\"{$this->vars['notes']->getSubject()}\">";
        echo "<input type=\"hidden\" name=\"klasse\" value=\"{$this->vars['notes']->getSchoolClass()}\">";
        echo "<input type=\"hidden\" name=\"clef\" value=\"{$this->vars['notes']->getClef()}\">";
        echo "<input type=\"hidden\" name=\"date\" value=\"{$this->vars['notes']->getDate()}\">";
        echo "<input type=\"hidden\" name=\"maxScore\" value=\"{$this->vars['notes']->getMaxScore()}\">";
        echo "<button type=\"submit\" type=\"button\" class=\"btn btn-primary active glyphicon glyphicon-ok\"> Speichern</button>";
        echo "</form>";
    }

}
