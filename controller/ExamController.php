<?php

include_once 'controller/Controller.php';
include_once 'model/SchoolClass.php';
include_once 'model/SchoolSubject.php';
include_once 'model/Exam.php';
include_once 'lib/MySqlAdapter.php';
include_once 'view/pruefungen/ExamView.php';
include_once 'view/pruefungen/ShowExamNotes.php';

class ExamController extends Controller {

    private $mysqlAdapter;

    public function __construct() {
        $this->mysqlAdapter = new MySqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    protected function create() {
        $subject = filter_input(INPUT_POST, 'subject', FILTER_VALIDATE_INT);
        $schoolClass = filter_input(INPUT_POST, 'schoolClass', FILTER_VALIDATE_INT);
        $clef = filter_input(INPUT_POST, 'clef', FILTER_DEFAULT);
        $date = filter_input(INPUT_POST, 'date', FILTER_DEFAULT);
        $maxScore = filter_input(INPUT_POST, 'maxScore', FILTER_VALIDATE_FLOAT);
        $this->mysqlAdapter->addExam($subject, $schoolClass, $clef, $date, $maxScore);
        $this->index();
    }

    protected function delete() {
        $id = $_GET['id'];
        $this->mysqlAdapter->deleteExam($id);
        $this->index();
    }

    protected function edit() {
        if (!preg_match("@^.*/edit-note@", $_SERVER['REQUEST_URI'])) {
            $id = filter_input(INPUT_POST, 'examId', FILTER_VALIDATE_INT);
            $subject = filter_input(INPUT_POST, 'subject', FILTER_VALIDATE_INT);
            $schoolClass = filter_input(INPUT_POST, 'schoolClass', FILTER_VALIDATE_INT);
            $clef = filter_input(INPUT_POST, 'clef', FILTER_DEFAULT);
            $date = filter_input(INPUT_POST, 'date', FILTER_DEFAULT);
            $maxScore = filter_input(INPUT_POST, 'maxScore', FILTER_VALIDATE_FLOAT);
            $this->mysqlAdapter->editExam($id, $subject, $schoolClass, $clef, $date, $maxScore, $note= NULL);
            $this->index();
        } else {
            $note = filter_input(INPUT_POST, 'note', FILTER_DEFAULT);
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            $this->mysqlAdapter->updateExamNote($id, $note);
            $this->index();
        }
    }

    protected function index() {
        $schoolExams = $this->mysqlAdapter->getExams();
        $schoolClassList = $this->mysqlAdapter->getSchoolclasses();
        $schoolSubjectList = $this->mysqlAdapter->getSchoolSubjects();
        $view = new ExamView();
        $view->assign1('list', $schoolExams);
        $view->assign1('schoolClassList', $schoolClassList);
        $view->assign1('schoolSubjectList', $schoolSubjectList);
        $view->display();
    }

    protected function init() {
        
    }

    protected function show() {
        
    }

    protected function showNotes() {

        $id = $_GET['id'];
        $notes = $this->mysqlAdapter->getExam($id);
        $view = new ShowExamNotes();
        $view->assign1('notes', $notes);
        $view->display();
    }

//put your code here
}
