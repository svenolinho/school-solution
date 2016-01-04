<?php

/**
 * Description of SchoolClass
 *
 * @author Ruben
 */
class SchoolClass {

    private $id;
    private $name;
    private $note;
    private $students = array();

    function __construct($id = 0, $name = '', $note = '') {
        $this->id = $id;
        $this->name = $name;
        $this->note = $note;
    }

    function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    function setName($name) {
        $this->name = $name;
    }

    function getNote() {
        return $this->note;
    }

    function setNote($note) {
        $this->note = $note;
    }

    function getStudents() {

        foreach ($this->students as $student) {
            return $student;
        }
    }

    function addStudent($student) {
        $this->students[] = $student;
    }

}
