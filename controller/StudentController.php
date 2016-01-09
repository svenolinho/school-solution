<?php

include_once 'controller/Controller.php';
include_once 'model/Student.php';
include_once 'lib/MySqlAdapter.php';
include_once 'view/View.php';
include_once 'view/studenten/StudentsListView.php';

class StudentController extends Controller {

    private $mysqlAdapter;

    public function __construct() {
        $this->mysqlAdapter = new MySqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    protected function create() {
        $firstName = $_POST['firstname'];
        $lastName = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $klasse = $_POST['klasse'];
        if (!is_numeric($klasse)) {
            $klasse = NULL;
        }
        $this->mysqlAdapter->addStudent($firstName, $lastName, $email, $phone, $klasse);
        header("Location: ".URI_STUDENTEN);
    }

    protected function index() {
        $studentList = $this->mysqlAdapter->getStudents();
        $classList = $this->mysqlAdapter->getSchoolclasses();

        $view = new StudentsListView();
        $view->assign1('studentList', $studentList);
        $view->assign2('classList', $classList);
        $view->display();
    }

    protected function init() {
        include_once 'view/studentForm.php';
    }

    protected function show() {
        
    }

    protected function delete() {
        $id = $_GET['id'];
        $this->mysqlAdapter->deleteStudent($id);
        header("Location: ".URI_STUDENTEN);
    }

    protected function edit() {
        $id = $_POST['student-id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $klasse = $_POST['klasse'];
        if (!is_numeric($klasse)) {
            $klasse = NULL;
        }
        $this->mysqlAdapter->editStudent($id, $firstname, $lastname, $email, $phone, $klasse);
        header("Location: ".URI_STUDENTEN);
    }

}
