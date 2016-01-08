<?php

class SchoolSubject {

    private $id;
    private $subjectName;

    function __construct($id, $subjectName = "") {
        $this->subjectName = $subjectName;
        $this->id = $id;
    }

    function getId() {
        return $this->id;
    }

    function getSubjectName() {
        return $this->subjectName;
    }
}
