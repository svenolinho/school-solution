<?php

class SchoolSubject {

    private $id;
    private $subjectName;
    private $teacher;
    private $schoolClass;

    function __construct($subjectName = "", array $schoolClass) {
        $this->subjectName = $subjectName;
        $this->schoolClass = $schoolClass;
    }

    function getId() {
        return $this->id;
    }

    function getSubjectName() {
        return $this->subjectName;
    }

    function getTeacher() {
        return $this->teacher;
    }

    function getSchoolClass() {
        return $this->schoolClass;
    }

    function setSubjectName($subjectName) {
        $this->subjectName = $subjectName;
    }

    function setTeacher($teacher) {
        $this->teacher = $teacher;
    }

    function setSchoolClass($schoolClass) {
        $this->schoolClass = $schoolClass;
    }

}
