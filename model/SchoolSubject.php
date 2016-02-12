<?php

class SchoolSubject {

    private $id;
    private $name;
    private $note;

    function __construct($id= 0, $name = '', $note = '') {
        $this->id = $id;
        $this->name = $name;
        $this->note = $note;
    }

    function getId() {
        return $this->id;
    }

    function getSubjectName() {
        return $this->name;
    }
    
    function getNote() {
        return $this->note;
    }
}
