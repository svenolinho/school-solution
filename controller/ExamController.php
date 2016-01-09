<?php

include_once 'controller/Controller.php';
include_once 'model/SchoolClass.php';
include_once 'model/SchoolSubject.php';
include_once 'model/Exam.php';
include_once 'lib/MySqlAdapter.php';
include_once 'view/pruefungen/ExamView.php';

class ExamController extends Controller {

    private $mysqlAdapter;

    public function __construct() {
        $this->mysqlAdapter = new MySqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    protected function create() {
        $subject = filter_input(INPUT_POST,'subject',FILTER_VALIDATE_INT);
        $schoolClass = filter_input(INPUT_POST,'schoolClass',FILTER_VALIDATE_INT);
        $clef = filter_input(INPUT_POST,'clef',FILTER_DEFAULT);
        $date = filter_input(INPUT_POST,'date',FILTER_DEFAULT);
        $maxScore = filter_input(INPUT_POST,'maxScore',FILTER_VALIDATE_FLOAT);
        $this->mysqlAdapter->addExam($subject, $schoolClass, $clef, $date, $maxScore);
        $this->index();
    }

    protected function delete() {
        $id = $_GET['id'];
        $this->mysqlAdapter->deleteExam($id);
        $this->index();
    }

    protected function edit() {
        $id = $_POST['schoolsubject-id'];
        $subjectName = $_POST['schoolsubject'];
        $this->mysqlAdapter->editExam($id, $subject, $schoolClass, $clef, $date, $maxScore);
        $this->index();
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

//put your code here
}
