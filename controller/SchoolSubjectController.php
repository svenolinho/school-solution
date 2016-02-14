<?php

include_once 'controller/Controller.php';
include_once 'model/SchoolSubject.php';
include_once 'lib/MySqlAdapter.php';
include_once 'view/View.php';
include_once 'view/faecher/SchoolSubjectView.php';
include_once 'view/faecher/ShowExamsFromSubject.php';
include_once 'view/faecher/ShowSchoolSubjectNotes.php';

class SchoolSubjectController extends Controller {

    private $mysqlAdapter;

    public function __construct() {
        $this->mysqlAdapter = new MySqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    protected function create() {
        $subjectName = filter_input(INPUT_POST, 'schoolsubject', FILTER_DEFAULT);
        if(!$subjectName){
            throw new Exception('manipulation');
        }
        $this->mysqlAdapter->addSchoolSubject($subjectName);
        header("Location: ".URI_FAECHER);
    }

    protected function delete() {
        $id = $_GET['id'];
        $this->mysqlAdapter->deleteSchoolSubject($id);
        header("Location: ".URI_FAECHER);
    }

    protected function edit() {
        $id = filter_input(INPUT_POST, 'schoolsubject-id', FILTER_VALIDATE_INT);
        $subjectName = filter_input(INPUT_POST, 'schoolsubject', FILTER_DEFAULT);
        if (preg_match("@^.*/edit-note@", $_SERVER['REQUEST_URI'])) {
            $note = filter_input(INPUT_POST, 'note', FILTER_DEFAULT);
            $this->mysqlAdapter->editSchoolsubjectNote($id, $note);
        } 
        
        if(!$id || !$subjectName){
            throw new Exception('manipulation');
        }
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
        $schoolSubject = $this->mysqlAdapter->getSchoolSubject($id);
        $examlist = $this->mysqlAdapter->getExamsFromSubjects($id);
        $view = new ShowExamsFromSubject();
        $view->assign1('list', $examlist);
        $view->assign1('schoolSubject', $schoolSubject);
        $view->display();
    }

    protected function showNotes() {
        
        $id = $_GET['id'];
        $notes = $this->mysqlAdapter->getSchoolSubject($id);
        $view = new ShowSchoolSubjectNotes();
        $view->assign1('notes', $notes);
        $view->display();
    }

//put your code here
}
