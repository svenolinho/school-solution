<?php

class Score {

    private $id;
    private $exam;
    private $student;
    private $present;
    private $score;

    function __construct($id, $exam, $student, $present, $score) {
        $this->id = $id;
        $this->exam = $exam;
        $this->student = $student;
        $this->present = $present;
        $this->score = $score;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getExam()
    {
        return $this->exam;
    }

    public function getStudent()
    {
        return $this->student;
    }

    public function getPresent()
    {
        return $this->present;
    }

    public function getScore()
    {
        return $this->score;
    }

}
