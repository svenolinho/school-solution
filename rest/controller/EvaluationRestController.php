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
        if($schoolclassId){
            $scores = $this->mysqlAdapter->getScoresForSchoolClass($schoolclassId);
            $count = count($scores);
            echo "[";
            $i = 0;
            foreach ($scores as $score) {
                echo "\"".$score->getEvaluatedScore()."\"";
                if(++$i !== $count) {
                    echo ",";
                }
            }
            echo "]";
        } else {
            http_response_code(400);
        }
    }

    protected function post()
    {
        // empty
    }
}