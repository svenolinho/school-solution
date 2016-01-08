<?php

/**
 * Description of Error
 *
 * @author Ruben
 */
class Error {
   
    public function displayClassDeleteError() {
        
        echo "<div class=\"alert alert-danger\" role=\"alert\">Diese Klasse kann nicht gelöscht werden. Bitte entfernen Sie zuerst alle Schüler aus der Klasse und wiederholen Sie den Vorgang.</div>";
        
    }
}
