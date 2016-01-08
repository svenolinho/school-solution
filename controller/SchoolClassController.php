<?php

include_once 'controller/Controller.php';
include_once 'model/SchoolSubject.php';
include_once 'lib/MySqlAdapter.php';
include_once 'view/View.php';
include_once 'view/klassen/ClassListView.php';
include_once 'view/klassen/ShowStudentsFromClass.php';

class SchoolClassController extends Controller {

    private $mysqlAdapter;

    public function __construct() {
        $this->mysqlAdapter = new MySqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    protected function index() {
        $classList = $this->mysqlAdapter->getSchoolclasses();
        $view = new ClassListView();
        $view->assign1('list', $classList);
        $view->display();
    }

    protected function init() {
        
    }

    protected function show() {
        $id = $_GET['id'];
        $studentslist = $this->mysqlAdapter->getStudentsFromClass($id);
        $view = new ShowStudentsFromClass();
        $view->assign1('list', $studentslist);
        $view->display();
    }

    protected function create() {
        $classname = $_POST['schoolclass'];
        $this->mysqlAdapter->addSchoolclass($classname);
        $this->index();
    }

    protected function delete() {
        $id = $_GET['id'];
        $this->mysqlAdapter->deleteClass($id);
        $this->index();
    }

    protected function edit() {
        $id = $_POST['schoolclass-id'];
        $classname = $_POST['schoolclass'];
        $this->mysqlAdapter->editSchoolclass($id, $classname);
        $this->index();
    }

}
