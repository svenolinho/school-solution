<?php

include_once 'controller/Controller.php';
include_once 'model/SchoolSubject.php';
include_once 'lib/MySqlAdapter.php';
include_once 'view/View.php';
include_once 'view/faecher/SchoolSubjectView.php';
include_once 'view/faecher/ShowExamsFromSubject.php';

class SchoolSubjectController extends Controller {

    private $mysqlAdapter;

    public function __construct() {
        $this->mysqlAdapter = new MySqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    protected function create() {
        $subjectName = $_POST['schoolsubject'];
        $this->mysqlAdapter->addSchoolSubject($subjectName);
        header("Location: ".URI_FAECHER);
    }

    protected function delete() {
        $id = $_GET['id'];
        $this->mysqlAdapter->deleteSchoolSubject($id);
        header("Location: ".URI_FAECHER);
    }

    protected function edit() {
        $id = $_POST['schoolsubject-id'];
        $subjectName = $_POST['schoolsubject'];
        $this->mysqlAdapter->editSchoolSubject($id, $subjectName);
        header("Location: ".URI_FAECHER);
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
        $id = $_GET['id'];
        $examlist = $this->mysqlAdapter->getExamsFromSubjects($id);
        $view = new ShowExamsFromSubject();
        $view->assign1('list', $examlist);
        $view->display();
    }

    protected function showNotes() {
        
    }

//put your code here
}
