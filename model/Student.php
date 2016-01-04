<?php

class Student {

    private $id;
    public $firstName;
    public $lastName;
    public $email;
    public $phone;
    public $note;
    public $schoolClass;

//    Zwingende Parameter nicht initialisieren
    function __construct($id = 0, $lastName = "", $firstName = "", $email = "", $phone = "",$note = "", $schoolClass = NULL) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->schoolClass = $schoolClass;
        $this->note = $note;
    }

    function getId() {
        return $this->id;
    }

    function getFirstName() {
        return $this->firstName;
    }

    function getLastName() {
        return $this->lastName;
    }

    function getEmail() {
        return $this->email;
    }

    function getPhone() {
        return $this->phone;
    }

    function getNote() {
        return $this->note;
    }

    function getSchoolClass() {
        return $this->schoolClass;
    }

    function getSchoolClassName() {
        if ($this->schoolClass == NULL) {
            return "";
        } else {
            return $this->schoolClass->getName();
        }
    }

    function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPhone($phone) {
        $this->phone = $phone;
    }

    function setNote($note) {
        $this->note = $note;
    }

    function setSchoolClass($schoolClass) {
        $this->schoolClass = $schoolClass;
    }

}
