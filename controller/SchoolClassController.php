<?php
include_once 'controller/Controller.php';
include_once 'model/SchoolClass.php';
include_once 'lib/MySqlAdapter.php';

class SchoolClassController extends Controller {

    private $mysqlAdapter;

    public function __construct() {
        $this->mysqlAdapter = new MySqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    protected function index() {
        $classList = $this->mysqlAdapter->getSchoolclasses();
        ?>
        <div class = "row">
            <div class = "col-md-4">
                <div class = "panel panel-default">
                    <div class = "panel-heading">
                        <h5>Klassen<a href="<?php echo URI_KLASSEN ?>/new-class" class="btn"><span class="glyphicon glyphicon-plus"></span></a></h5> 
                    </div>



                    <table class = "table table-condensed">
                        <tbody>
                            <?php
                            foreach ($classList as $class) {
                                $id = $class->getId();
                                $urlClass = URI_KLASSEN . "/{$id}-" . self::encodeUrl("{$class->getName()}");
                                $urlDelete = URI_KLASSEN . "/delete";
                                echo "<tr>";
                                echo "<td><a href=\"$urlClass\" class=\"list-group-item\">{$class->getName()}</a></td>";
                                echo "<td><a href=\"$urlDelete?id=$id\"  class=\"btn btn-danger\" role=\"button\"><span class=\"glyphicon glyphicon-trash\"></span></a></td>";
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
        include_once 'view/schoolclassForm.php';
    }

    protected function show() {
        $classList = $this->mysqlAdapter->getSchoolclasses();
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
        foreach ($classList as $class) {
            
        }
    }

    protected function create() {
        $value = $_POST['class_name'];
        $this->mysqlAdapter->addSchoolclass($value);
    }

    protected function delete() {
        $id = $_GET['id'];
        $classList = $this->mysqlAdapter->deleteClass($id);
    }

    protected function edit() {
        
    }

}
