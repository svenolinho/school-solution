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

        echo "<form action=\"edit-note-{$this->vars['notes']->getId()}\" method=\"POST\" name=\"noteForm\">";
        echo "<input type=\"hidden\" name=\"id\" value=\"{$this->vars['notes']->getId()}\"/>";
        echo "<textarea id=\"note\" name=\"note\" rows = \"10\" cols = \"100\">";
        echo "{$this->vars['notes']->getNote()}";
        echo "</textarea><br>";
        echo "<button type=\"submit\" type=\"button\" class=\"btn btn-primary active glyphicon glyphicon-ok\"> Speichern</button>";
        echo "</form>";
    }

}
