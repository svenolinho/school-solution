<?php

include_once 'controller/Controller.php';
include_once 'model/SchoolClass.php';
include_once 'lib/MySqlAdapter.php';
include_once 'view/View.php';
include_once 'view/faecher/SchoolSubjectView.php';

class SchoolSubjectController extends Controller {

    private $mysqlAdapter;

    public function __construct() {
        $this->mysqlAdapter = new MySqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    protected function create() {
        $subjectName = $_POST['schoolSubject'];
        $this->mysqlAdapter->addSchoolSubject($subjectName);
        $this->index();
    }

    protected function delete() {
        $id = $_GET['id'];
        $this->mysqlAdapter->deleteSchoolSubject($id);
        $this->index();
    }

    protected function edit() {
        $id = $_POST['schoolSubject-id'];
        $subjectName = $_POST['schoolSubject'];
        $this->mysqlAdapter->editSchoolclass($id, $subjectName);
        $this->index();
    }

    protected function index() {
        $schoolSubjectList = $this->mysqlAdapter->getSchoolSubjects();
        $view = new SchoolSubjectView();
        $view->assign1('list', $schoolSubjectList);
        $view->display();
    }

    protected function init() {
        
    }

    protected function show() {
        
    }

//put your code here
}