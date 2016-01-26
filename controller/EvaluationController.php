<?php

include_once 'controller/Controller.php';
include_once 'model/Evaluation.php';
include_once 'lib/MySqlAdapter.php';
include_once 'view/auswertung/EvaluationView.php';

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
        $view = new EvaluationView();
        $view->display();
        
    }

    protected function init() {
        
    }

    protected function show() {
        
    }

    protected function showNotes() {
        
    }

//put your code here
}
