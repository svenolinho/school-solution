<?php
include_once 'controller/Controller.php';
include_once 'model/Student.php';
include_once 'lib/MySqlAdapter.php';

class StudentController extends Controller {

    private $mysqlAdapter;

    public function __construct() {
        $this->mysqlAdapter = new MySqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    protected function create() {
        $firstName = $_POST['first_name'];
        $lastName = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $this->mysqlAdapter->addStudent($firstName, $lastName, $email, $phone);
    }

    protected function index() {
        $studentList = $this->mysqlAdapter->getStudents();
        ?>
        <div class = "row">
            <div class = "col-md-10">
                <div class = "panel panel-default">
                    <div class = "panel-heading">
                        <h5>Studenten<a href="<?php echo URI_STUDENTEN ?>/new-student" class="btn"><span class="glyphicon glyphicon-plus"></span></a></h5> 
                    </div>




                    <table class = "table table-condensed">
                        <thead>
                            <tr>
                                <th>Vorname</th>
                                <th>Nachname</th>
                                <th>E-Mail</th>
                                <th>Telefonnummer</th>
                                <th>Klasse</th>

                            </tr>
                        </thead>
                        <tbody>                

                            <?php
                            foreach ($studentList as $student) {
                                $id = $student->getId();
                                $urlDelete = URI_STUDENTEN . "/delete";
                                $urlEdit = URI_STUDENTEN . "/edit";
                                echo "<tr>";
                                echo "<td>{$student->getFirstName()}</td>";
                                echo "<td>{$student->getLastName()}</td>";
                                echo "<td>{$student->getEmail()}</td>";
                                echo "<td>{$student->getPhone()}</td>";
                                echo "<td>{$student->getSchoolClassName()}</td>";
                                echo "<td><a href=\"$urlDelete?id=$id\"  class=\"btn btn-danger\" role=\"button\"><span class=\"glyphicon glyphicon-trash\"></span></a>
                                <a href=\"$urlEdit?id=$id\"  class=\"btn btn-primary\" role=\"button\"><span class=\"glyphicon glyphicon-pencil\"></span></a></td></td>";
                                echo "</tr>";
                            }
                            ?>           

                        </tbody>
                    </table>




                </div>   
            </div>
        </div>

        <?php
    }

    protected function init() {
        include_once 'view/studentForm.php';
    }

    protected function show() {
        $studentList = $this->mysqlAdapter->getStudents();
        echo <<<TEST
                <div class="col-md-9">
                <table class = "table table-condensed">
                <thead>
                    <tr>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Class</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>                
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>           
                    </tr>
                </tbody>
                </table>
                </div>                    
TEST;
        foreach ($studentList as $student) {
            
        }
    }

    protected function delete() {
        $id = $_GET['id'];
        $studentList = $this->mysqlAdapter->deleteStudent($id);
    }

    protected function edit() {
        $id = $_GET['id'];
        $studentList = $this->mysqlAdapter->editStudent($id, $first_name, $lastname, $email, $phone);
    }

}
