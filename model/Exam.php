<?php

class Exam {

    private $id;
    private $subject;
    private $schoolClass;
    private $clef;
    private $date;
    private $maxScore;

    function __construct($id, $subject, $schoolClass, $clef, $date, $maxScore) {
        $this->id = $id;
        $this->subject = $subject;
        $this->schoolClass = $schoolClass;
        $this->clef = $clef;
        $this->date = $date;
        $this->maxScore = $maxScore;
    }

    function getId() {
        return $this->id;
    }

    function getSubjectName() {
        return $this->subject->getSubjectName();
    }

    function getSubjectId() {
        return $this->subject->getId();
    }

    function getSchoolClassName() {
        return $this->schoolClass->getName();
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
