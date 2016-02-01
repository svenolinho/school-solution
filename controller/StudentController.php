<?php

include_once 'controller/Controller.php';
include_once 'model/Student.php';
include_once 'lib/MySqlAdapter.php';
include_once 'view/View.php';
include_once 'view/studenten/StudentsListView.php';
include_once 'view/studenten/ShowStudentsNotes.php';

class StudentController extends Controller
{

    private $mysqlAdapter;

    public function __construct()
    {
        $this->mysqlAdapter = new MySqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    protected function create()
    {
        $firstName = filter_input(INPUT_POST, 'firstname', FILTER_DEFAULT);
        $lastName = filter_input(INPUT_POST, 'lastname', FILTER_DEFAULT);
        $email = filter_input(INPUT_POST, 'email', FILTER_DEFAULT);
        $phone = filter_input(INPUT_POST, 'phone', FILTER_DEFAULT);
        $klasse = filter_input(INPUT_POST, 'klasse', FILTER_VALIDATE_INT);
        if (!$firstName || !$lastName || !$email || !$phone) {
            throw new Exception("form manipulation");
        }
        if (!$klasse) {
            $klasse = NULL;
        }
        $this->mysqlAdapter->addStudent($firstName, $lastName, $email, $phone, $klasse);
        header("Location: " . URI_STUDENTEN);
    }

    protected function index()
    {
        $studentList = $this->mysqlAdapter->getStudents();
        $classList = $this->mysqlAdapter->getSchoolclasses();

        $view = new StudentsListView();
        $view->assign1('studentList', $studentList);
        $view->assign2('classList', $classList);
        $view->display();
    }

    protected function init()
    {
        include_once 'view/studentForm.php';
    }

    protected function show()
    {

    }

    protected function showNotes()
    {

        $id = $_GET['id'];
        $notes = $this->mysqlAdapter->getStudent($id);
        $view = new ShowStudentsNotes();
        $view->assign1('notes', $notes);
        $view->display();
    }

    protected function delete()
    {
        $id = $_GET['id'];
        $this->mysqlAdapter->deleteStudent($id);
        header("Location: " . URI_STUDENTEN);
    }

    protected function edit()
    {
        $id = filter_input(INPUT_POST, 'student-id', FILTER_VALIDATE_INT);
        if(!$id){
            throw new Exception('manipulation');
        }
        if (preg_match("@^.*/edit-note@", $_SERVER['REQUEST_URI'])) {
            $note = filter_input(INPUT_POST, 'note', FILTER_DEFAULT);
            $this->mysqlAdapter->editStudentNote($id, $note);
        } else {
            $firstname = filter_input(INPUT_POST, 'firstname', FILTER_DEFAULT);
            $lastname = filter_input(INPUT_POST, 'lastname', FILTER_DEFAULT);
            $email = filter_input(INPUT_POST, 'email', FILTER_DEFAULT);
            $phone = filter_input(INPUT_POST, 'phone', FILTER_DEFAULT);
            $klasse = filter_input(INPUT_POST, 'klasse', FILTER_VALIDATE_INT);
            if(!$firstname || !$lastname || !$email || !$phone ){
                throw new Exception('manipulation');
            }
            $this->mysqlAdapter->editStudent($id, $firstname, $lastname, $email, $phone, $klasse);
        }
        header("Location: " . URI_STUDENTEN);
    }

}
