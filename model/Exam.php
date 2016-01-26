<?php

class Exam {

    private $id;
    private $subject;
    private $schoolClass;
    private $clef;
    private $date;
    private $maxScore;
    private $note;

    function __construct($id, $subject, $schoolClass, $clef, $date, $maxScore, $note = "") {
        $this->id = $id;
        $this->subject = $subject;
        $this->schoolClass = $schoolClass;
        $this->clef = $clef;
        $this->date = $date;
        $this->maxScore = $maxScore;
        $this->note = $note;
        
    }

    function getId() {
        return $this->id;
    }
    
    function getNote(){
        return $this->note;
    }

    function getSubjectName() {
        return $this->subject->getSubjectName();
    }
    
    function getSubject(){
        return $this->subject;
    }

    function getSubjectId() {
        return $this->subject->getId();
    }

    function getSchoolClassName() {
        return $this->schoolClass->getName();
    }
    function getSchoolClass(){
        return $this->schoolClass;
    }

    function getSchoolClassId() {
        return $this->schoolClass->getId();
    }

    function getClef() {
        return $this->clef;
    }

    function getDate() {
        return $this->date;
    }

    function getMaxScore() {
        return $this->maxScore;
    }

}
