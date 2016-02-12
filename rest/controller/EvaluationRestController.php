<?php

include_once 'lib/MySqlAdapter.php';
include_once 'rest/controller/RestController.php';
include_once 'model/Exam.php';

class EvaluationRestController extends RestController
{

    public function __construct() {
        $this->mysqlAdapter = new MySqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    protected function get()
    {
        header("Content-Type: application/javascript");
        $schoolclassId = filter_input(INPUT_GET, 'schoolclassId', FILTER_DEFAULT);
        $studentId = filter_input(INPUT_GET, 'studentId', FILTER_DEFAULT);
        $action = filter_input(INPUT_GET, 'action', FILTER_DEFAULT);
        $students = filter_input(INPUT_GET, 'students', FILTER_VALIDATE_INT, FILTER_REQUIRE_ARRAY);
        if($schoolclassId && $action === "scores"){
            $this->displayScores($schoolclassId);
        } else if($schoolclassId && $action === "scoreAverages"){
            $this->displayScoreAverages($schoolclassId);
        } else if($action === "scoreComparison"){
            $this->displayScoreComparison();
        } else if($studentId && $action === "studentScores"){
            $this->displayStudentScores($studentId);
        } else if($schoolclassId && $action === "getStudents"){
            $this->displayStudentsOfClass($schoolclassId);
        } else if($action === "studentComparison" && $students){
            $this->displayStudentComparison($students);
        } else {
            http_response_code(400);
        }
    }

    protected function post()
    {
        // empty
    }

    private function groupByExams($scores){
        $grouped = array();
        foreach ($scores as $score) {
            $grouped[$score->getExam()->getId()]=$score->getExam();
        }
        return $grouped;
    }

    protected function displayScores($schoolclassId)
    {
        $scores = $this->mysqlAdapter->getScoresForSchoolClass($schoolclassId);
        $count = count($scores);
        echo "[";
        $i = 0;
        foreach ($scores as $score) {
            echo "{";
            echo "\"evaluatedScore\": " . $score->getEvaluatedScore().",";
            $student = $score->getStudent();
            echo "\"student\": \"" . $student->getLastName() ." ".$student->getFirstName()."\",";
            $date = new DateTime($score->getExam()->getDate());
            echo "\"date\": \"" .$date->format("d.m.Y") ."\",";
            echo "\"subject\": \"" .$score->getSubject()->getSubjectName() ."\"";
            if (++$i !== $count) {
                echo "},";
            }else{
                echo "}";
            }
        }
        echo "]";
    }

    protected function displayScoreAverages($schoolclassId)
    {
        $scores = $this->mysqlAdapter->getScoresForSchoolClass($schoolclassId);
        $exams = $this->groupByExams($scores);
        usort($exams, function($a,$b){
            $t1 = strtotime($a->getDate());
            $t2 = strtotime($b->getDate());
            return ($t1 - $t2);
        });
        $count = count($exams);
        echo "[";
        $i = 0;
        foreach ($exams as $exam) {
            echo "[";

            $date = new DateTime($exam->getDate());
            echo "\"" . $date->format("Y-m-d") . "\",";
            echo round($exam->getAverageEvaluatedScore(),4);
            if (++$i !== $count) {
                echo "],";
            } else {
                echo "]";
            }
        }
        echo "]";
    }

    private function displayScoreComparison()
    {
        $classes = filter_input(INPUT_GET, 'classes', FILTER_VALIDATE_INT, FILTER_REQUIRE_ARRAY);
        $subjects = filter_input(INPUT_GET, 'subjects', FILTER_VALIDATE_INT, FILTER_REQUIRE_ARRAY);
        $scoresBySubjectAndClass = $this->mysqlAdapter->getScoresBySubjectAndClass($subjects, $classes);

        echo "{";
        echo "\"cols\": [{\"id\": \"fach\", \"label\": \"Fach\", \"type\":\"string\"},";
        $schoolClasses = $this->mysqlAdapter->getSchoolclasses();
        $classCount = count($classes);
        $i = 0;
        foreach ($classes as $classId) {
            $schoolClass = $this->getById($classId, $schoolClasses);
            echo sprintf("{\"id\":\"id-%d\", \"label\": \"%s\", \"type\":\"number\"}", $classId, $schoolClass->getName());
            if (++$i !== $classCount) {
                echo ",";
            }
        }
        echo "],";

        echo "\"rows\": [";
        $schoolSubjects = $this->mysqlAdapter->getSchoolSubjects();
        $subjectCount = count($subjects);
        $i = 0;
        foreach ($subjects as $subjectId) {
            $schoolSubject = $this->getById($subjectId, $schoolSubjects);
            echo "{\"c\":[{\"v\": \"".$schoolSubject->getSubjectName()."\"}";
            foreach ($classes as $classId) {
                $averageScore = 0;
                if(isset($scoresBySubjectAndClass[$subjectId]) && isset($scoresBySubjectAndClass[$subjectId][$classId])){
                    $averageScore = $this->getAverageScore($scoresBySubjectAndClass[$subjectId][$classId]);
                }
                echo sprintf(",{\"v\": %f}",$averageScore);
            }
            echo "]}";
            if (++$i !== $subjectCount) {
                echo ",";
            }
        }
        echo "]";
        echo "}";
    }

    private function getById($id, $schoolSubjects){
        foreach ($schoolSubjects as $subject) {
            if($id == $subject->getId()){
                return $subject;
            }
        }
        return NULL;
    }

    private function getAverageScore($scores)
    {
        if(count($scores)<1){
            return 0;
        }
        $sum = 0;
        foreach ($scores as $score) {
            $sum += $score->getEvaluatedScore();
        }
        return $sum / count($scores);
    }

    private function displayStudentScores($studentId)
    {
        $scores = $this->mysqlAdapter->getStudentScores($studentId);
        $count = count($scores);
        echo "[";
        $i = 0;
        foreach ($scores as $score) {
            echo "{";
            echo "\"evaluatedScore\": " . $score->getEvaluatedScore().",";
            $date = new DateTime($score->getExam()->getDate());
            echo "\"date\": \"" .$date->format("Y-m-d") ."\",";
            echo "\"subjectId\": " .$score->getExam()->getSubject()->getId() .",";
            echo "\"subject\": \"" .$score->getSubject()->getSubjectName() ."\"";
            if (++$i !== $count) {
                echo "},";
            }else{
                echo "}";
            }
        }
        echo "]";
    }

    private function displayStudentsOfClass($schoolclassId)
    {
        $students = $this->mysqlAdapter->getStudentsFromClass($schoolclassId);
        $count = count($students);
        echo "[";
        $i = 0;
        foreach ($students as $student) {
            echo "{";
            echo "\"id\": " . $student->getId().",";
            echo "\"name\": \"" .$student->getLastName() . " " . $student->getFirstName() ."\"";
            if (++$i !== $count) {
                echo "},";
            }else{
                echo "}";
            }
        }
        echo "]";
    }

    private function displayStudentComparison($students)
    {
        $scoresGroupedByStudent = array();
        foreach ($students as $studentId) {
            $studentScores = $this->mysqlAdapter->getStudentScores($studentId);
            if($studentScores) {
                $scoresGroupedByStudent[] = $studentScores;
            }
        }
        echo "{";
        echo "\"cols\": [{\"id\": \"student\", \"label\": \"Studenten\", \"type\":\"string\"}";
        foreach ($scoresGroupedByStudent as $studentScores) {
            $student = $this->getFirstStudentOfScores($studentScores);
            echo sprintf(",{\"id\":\"id-%d\", \"label\": \"%s % s\", \"type\":\"number\"}", $student->getId(),$student->getLastName(), $student->getFirstName());
        }
        echo "],";

        echo "\"rows\": [";
        echo "{\"c\":[{\"v\": \"Studenten\"}";
        foreach ($scoresGroupedByStudent as $studentScores) {
            $averageScore = $this->getAverageScore($studentScores);
            echo sprintf(",{\"v\": %f}",$averageScore);
        }
        echo "]}]}";
    }

    private function getFirstStudentOfScores($studentScores)
    {
        if(count($studentScores) > 0){
            return array_shift($studentScores)->getStudent();
        }
        return NULL;
    }
}