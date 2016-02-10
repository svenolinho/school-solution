<?php

include_once 'controller/Controller.php';
include_once 'model/SchoolClass.php';
include_once 'model/SchoolSubject.php';
include_once 'model/Student.php';
include_once 'lib/MySqlAdapter.php';
include_once 'view/auswertung/EvaluationView.php';
include_once 'view/auswertung/EvaluationScoreDistributionView.php';
include_once 'view/auswertung/EvaluationScoreAverageView.php';
include_once 'view/auswertung/EvaluationScoreComparisonView.php';
include_once 'view/auswertung/EvaluationStudentScoreView.php';

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
        }else if (preg_match("@/comparison@", $_SERVER['REQUEST_URI'])) {
            $view = new EvaluationScoreComparisonView();
            $view->assign1("classList",$this->mysqlAdapter->getSchoolclasses());
            $view->assign1("subjectList",$this->mysqlAdapter->getSchoolSubjects());
            $view->display();
        }else if (preg_match("@/studentScores@", $_SERVER['REQUEST_URI'])) {
            $view = new EvaluationStudentScoreView();
            $view->assign1("studentList",$this->mysqlAdapter->getStudents());
            $view->assign1("subjectList",$this->mysqlAdapter->getSchoolSubjects());
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
