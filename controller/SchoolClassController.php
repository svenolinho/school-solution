<?php

include_once 'controller/Controller.php';
include_once 'model/SchoolClass.php';
include_once 'lib/MySqlAdapter.php';
include_once 'lib/MySqlResult.php';
include_once 'view/View.php';
include_once 'view/klassen/ClassListView.php';
include_once 'view/klassen/ShowStudentsFromClass.php';
include_once 'view/klassen/ShowSchoolClassNotes.php';

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
        $classname = filter_input(INPUT_POST, 'schoolclass', FILTER_DEFAULT);
        if(!$classname || !preg_match('@^B\d{2}[a-zA-Z]{2}\d\.\d$@',$classname)){
            throw new Exception('manipulation');
        }
        $this->mysqlAdapter->addSchoolclass($classname);
        header("Location: " . URI_KLASSEN);
    }

    protected function delete() {
        $id = $_GET['id'];
        $mysqlResult = $this->mysqlAdapter->deleteClass($id);
        $classList = $this->mysqlAdapter->getSchoolclasses();
        $view = new ClassListView();
        $view->assign1("mysqlResult", $mysqlResult);
        $view->assign1('list', $classList);
        $view->display();
    }

    protected function edit()
    {
        $id = filter_input(INPUT_POST, 'schoolclass-id', FILTER_VALIDATE_INT);
        if(!$id){
            throw new Exception('manipulation');
        }
        if (preg_match("@^.*/edit-note@", $_SERVER['REQUEST_URI'])) {
            $note = filter_input(INPUT_POST, 'note', FILTER_DEFAULT);
            $this->mysqlAdapter->editSchoolclassNote($id, $note);
        } else {
            $classname = filter_input(INPUT_POST, 'schoolclass', FILTER_DEFAULT);
            if (!$classname || !preg_match('@B\d{2}[a-zA-Z]{2}\d\.\d$@',$classname)) {
                throw new Exception('manipulation');
            }
            $this->mysqlAdapter->editSchoolclass($id, $classname);
        }
        header("Location: " . URI_KLASSEN);
    }

    protected function showNotes() {

        $id = $_GET['id'];
        $notes = $this->mysqlAdapter->getSchoolClass($id);
        $view = new ShowSchoolClassNotes();
        $view->assign1('notes', $notes);
        $view->display();
    }

}
