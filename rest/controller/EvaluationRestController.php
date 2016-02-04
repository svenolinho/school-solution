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
        $action = filter_input(INPUT_GET, 'action', FILTER_DEFAULT);
        if($schoolclassId && $action === "scores"){
            $this->displayScores($schoolclassId);
        } else if($schoolclassId && $action === "scoreAverages"){
            $this->displayScoreAverages($schoolclassId);
        } else {
            http_response_code(400);
        }
    }

    protected function post()
    {
        // empty
    }

    private function reduceToExams($scores){
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
            echo "\"" . $score->getEvaluatedScore() . "\"";
            if (++$i !== $count) {
                echo ",";
            }
        }
        echo "]";
    }

    protected function displayScoreAverages($schoolclassId)
    {
        $scores = $this->mysqlAdapter->getScoresForSchoolClass($schoolclassId);
        $exams = $this->reduceToExams($scores);
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
}