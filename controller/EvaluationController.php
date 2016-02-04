<?php

include_once 'controller/Controller.php';
include_once 'model/SchoolClass.php';
include_once 'lib/MySqlAdapter.php';
include_once 'view/auswertung/EvaluationView.php';
include_once 'view/auswertung/EvaluationScoreDistributionView.php';
include_once 'view/auswertung/EvaluationScoreAverageView.php';

class EvaluationController extends Controller {

    private $mysqlAdapter;

    public function __construct() {
        $this->mysqlAdapter = new MySqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    protected function create() {
        
    }

    protected function delete() {
        
    }

    protected function edit() {
        
    }

    protected function index() {
        if (preg_match("@/distribution@", $_SERVER['REQUEST_URI'])) {
            $view = new EvaluationScoreDistributionView();
            $view->assign1("classList",$this->mysqlAdapter->getSchoolclasses());
            $view->display();
        }else if (preg_match("@/average@", $_SERVER['REQUEST_URI'])) {
            $view = new EvaluationScoreAverageView();
            $view->assign1("classList",$this->mysqlAdapter->getSchoolclasses());
            $view->display();
        }else {
            $view = new EvaluationView();
            $view->display();
        }
    }

    protected function init() {
        
    }

    protected function show() {
        
    }

    protected function showNotes() {
        
    }

//put your code here
}
