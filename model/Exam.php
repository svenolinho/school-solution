<?php

class Exam {
    private $id;
    private $subject;
    private $schoolClass;
    private $clef;
    private $date;
    private $maxScore;
    private $studentScores = array();
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

    public function addStudentScore($score)
    {
        $this->studentScores[]=$score;
    }

    /**
     * @return array
     */
    public function getStudentScores()
    {
        return $this->studentScores;
    }

    public static function isValidClef($clef){
        $clef = preg_replace('/\s+/', '', $clef);
        // e variable must be present
        if(!preg_match('/e(?![xm])/',$clef)){
            return false;
        }
        // m variable must be present
        if(!preg_match('/m(?!e)/',$clef)){
            return false;
        }
        // https://regex101.com/r/cD1wA0/
        $numbers = "(?:\d+(?:[.]\d+)?|e|m)(?!\(|(?2))";
        $functions = "(?:sinh?|cosh?|tanh?|abs|acosh?|asinh?|atanh?|exp|log10|deg2rad|rad2deg|sqrt|ceil|floor|round)\s*\((?1)(?:,(?1))?+\)(?!\(|(?2))";
        $evalRegex = "/^((".$numbers."|".$functions."|\((?1)+\))(?:[+\/*\^-](?1))?)+$/";
        return preg_match($evalRegex, $clef);
    }

    public function getPrettyClef($scoredString,$maxScoreString){
        $prettyClef = preg_replace('/e(?![xm])/',$scoredString,$this->clef);
        $prettyClef = preg_replace('/m(?!e)/',$maxScoreString,$prettyClef);
        return $prettyClef;
    }

    public function getAverageEvaluatedScore(){
        $sum = 0;
        foreach ($this->studentScores as $score) {
            $sum += $score->getEvaluatedScore();
        }
        return $sum / count($this->studentScores);
    }
}
