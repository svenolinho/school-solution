<?php

include_once 'controller/Controller.php';
include_once 'model/SchoolClass.php';
include_once 'model/SchoolSubject.php';
include_once 'model/Exam.php';
include_once 'lib/MySqlAdapter.php';
include_once 'view/pruefungen/ExamView.php';
include_once 'view/pruefungen/ScoreView.php';
include_once 'view/pruefungen/ShowExamNotes.php';

class ExamController extends Controller {

    private $mysqlAdapter;

    public function __construct() {
        $this->mysqlAdapter = new MySqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    protected function create() {
        if(preg_match("@^.*/new-score@", $_SERVER['REQUEST_URI'])){
            $examId = filter_input(INPUT_POST, 'examId', FILTER_VALIDATE_INT);
            $studentId = filter_input(INPUT_POST, 'studentId', FILTER_VALIDATE_INT);
            $present = filter_input(INPUT_POST, 'present', FILTER_VALIDATE_BOOLEAN);
            if(!$present){
                $present = false;
            }
            $score = filter_input(INPUT_POST, 'score', FILTER_VALIDATE_FLOAT);
            if(!$examId){
                throw new Exception('manipulation');
            }
            $exam = $this->mysqlAdapter->getExam($examId);
            if($score > $exam->getMaxScore() || !$studentId){
                throw new Exception('manipulation');
            }
            $this->mysqlAdapter->addExamScore($examId, $studentId, $present, $score);
            $this->showExam($examId);
        }else {
            $subject = filter_input(INPUT_POST, 'subject', FILTER_VALIDATE_INT);
            $schoolClass = filter_input(INPUT_POST, 'schoolClass', FILTER_VALIDATE_INT);
            $clef = filter_input(INPUT_POST, 'clef', FILTER_DEFAULT);
            if(!$subject || !$schoolClass || !$clef || !Exam::isValidClef($clef)){
                throw new Exception('manipulation');
            }
            $date = filter_input(INPUT_POST, 'date', FILTER_DEFAULT);
            if(!$date){
                throw new Exception('manipulation');
            }
            $maxScore = filter_input(INPUT_POST, 'maxScore', FILTER_VALIDATE_FLOAT);
            $this->mysqlAdapter->addExam($subject, $schoolClass, $clef, $date, $maxScore);
            $this->index();
        }
    }

    protected function delete() {
        if(preg_match("@^.*/delete-score@", $_SERVER['REQUEST_URI'])){
            $scoreId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            $examId = $this->mysqlAdapter->getExamIdOfScore($scoreId);
            $this->mysqlAdapter->deleteScore($scoreId);
            $this->showExam($examId);
        } else {
            $examId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            $this->mysqlAdapter->deleteExam($examId);
            $this->index();
        }
    }

    protected function edit() {
        if (preg_match("@^.*/edit-note@", $_SERVER['REQUEST_URI'])) {
            $note = filter_input(INPUT_POST, 'note', FILTER_DEFAULT);
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            $this->mysqlAdapter->updateExamNote($id, $note);
            $this->index();
        } else if (preg_match("@^.*/edit-score@", $_SERVER['REQUEST_URI'])) {
            $scoreId = filter_input(INPUT_POST, 'scoreId', FILTER_VALIDATE_INT);
            $studentId = filter_input(INPUT_POST, 'studentId', FILTER_VALIDATE_INT);
            $present = filter_input(INPUT_POST, 'present', FILTER_VALIDATE_BOOLEAN);
            if(!$present){
                $present = false;
            }
            $score = filter_input(INPUT_POST, 'score', FILTER_VALIDATE_FLOAT);
            $this->mysqlAdapter->updateScore($scoreId, $studentId,$present,$score);
            $examId = $this->mysqlAdapter->getExamIdOfScore($scoreId);
            $this->showExam($examId);
        } else {
            $id = filter_input(INPUT_POST, 'examId', FILTER_VALIDATE_INT);
            $subject = filter_input(INPUT_POST, 'subject', FILTER_VALIDATE_INT);
            $schoolClass = filter_input(INPUT_POST, 'schoolClass', FILTER_VALIDATE_INT);
            $clef = filter_input(INPUT_POST, 'clef', FILTER_DEFAULT);
            if(!Exam::isValidClef($clef)){
                throw new Exception('manipulation');
            }
            $date = filter_input(INPUT_POST, 'date', FILTER_DEFAULT);
            if(!$date){
                throw new Exception('manipulation');
            }
            $maxScore = filter_input(INPUT_POST, 'maxScore', FILTER_VALIDATE_FLOAT);
            $this->mysqlAdapter->editExam($id, $subject, $schoolClass, $clef, $date, $maxScore, $note= NULL);
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
        exit;
    }

    protected function init() {
        
    }

    protected function show() {
        $examId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $this->showExam($examId);
    }

    private function showExam($examId){
        $exam = $this->mysqlAdapter->getExamWithStudentScore($examId);
        $students = $this->mysqlAdapter->getStudentsOfClass($exam->getSchoolClassId());
        $view = new ScoreView();
        $view->assign1('exam', $exam);
        $view->assign1('students', $students);
        $view->display();
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
