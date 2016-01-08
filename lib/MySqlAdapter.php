<?php
include_once 'view/Error.php';
/**
 * Description of MySqlAdapter
 *
 * @author Ruben
 */
class MySqlAdapter {

    private $host;
    private $user;
    private $password;
    private $db;
    private $con;

    function __construct($host, $user, $password, $db) {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->db = $db;

        $this->open();
    }

    public function __destruct() {
        $this->close();
    }

    private function open() {
        $this->con = new mysqli($this->host, $this->user, $this->password, $this->db);
        if ($this->con->connect_errno) {
            echo 'DB Error: ' . $this->con->connect_error;
            $this->con = null;
        } else {
            $this->con->set_charset('utf8');
        }
    }

    private function close() {
        if ($this->con != null) {
            $this->con->close();
            $this->con = null;
        }
    }

    public function getSchoolclasses() {
        $schoolClassList = array();
        $res = $this->con->query("SELECT * FROM klasse ORDER BY KLA_name");
        while ($row = $res->fetch_assoc()) {
            $class = new SchoolClass($row['PK_Klassenr'], $row['KLA_name'], $row['KLA_notiz']);
            $schoolClassList[] = $class;
        }
        $res->free();
        return $schoolClassList;
    }

    public function addSchoolclass($classname) {

        $stmt = $this->con->prepare("INSERT INTO klasse (KLA_name) VALUES (?)");
        $stmt->bind_param("s", $classname);

        if ($stmt->execute()) {
            
        } else {
            echo "Error: <br>" . mysqli_error($this->con);
        }
    }

    public function getStudents() {
        include_once 'model/SchoolClass.php';
        $list = array();
        $res = $this->con->query("SELECT * FROM student LEFT JOIN klasse ON student.STU_klasse=klasse.PK_Klassenr ORDER BY STU_name");
        while ($row = $res->fetch_assoc()) {
            $klasse = new SchoolClass($row['PK_Klassenr'], $row['KLA_name'], $row['KLA_notiz']);
            $student = new Student($row['PK_Studnr'], $row['STU_name'], $row['STU_vorname'], $row['STU_mail'], $row['STU_telnr'], $row['STU_notiz'], $klasse);
            $list[] = $student;
        }
        $res->free();
        return $list;
    }

    public function addStudent($firstName, $lastName, $email, $phone, $klasse = NULL) {
        $stmt = $this->con->prepare("INSERT INTO student (STU_vorname,STU_name,STU_mail,STU_telnr,STU_klasse) VALUES (?,?,?,?,?)");
        $stmt->bind_param("ssssi", $firstName, $lastName, $email, $phone, $klasse);

        if ($stmt->execute()) {
            
        } else {
            echo "Error: <br>" . mysqli_error($this->con);
        }
    }

    public function deleteClass($id) {
        $stmt = $this->con->prepare("DELETE FROM klasse WHERE PK_Klassenr=?;");
        $stmt->bind_param("s", $id);
        if (!$stmt->execute()) {
            $error = new Error();
            $error->displayClassDeleteError();
        }
    }

    public function deleteStudent($id) {
        $stmt = $this->con->prepare("DELETE FROM student WHERE PK_Studnr=?;");
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            echo "Error: <br>" . mysqli_error($this->con);
        }
    }

    public function editStudent($id, $firstname, $lastname, $email, $phone, $klasse = NULL) {
        $stmt = $this->con->prepare("UPDATE student SET STU_name = ?, STU_vorname = ?, STU_mail = ?, STU_telnr = ?, STU_klasse = ? WHERE PK_Studnr = ?");
        $stmt->bind_param("sssssi", $lastname, $firstname, $email, $phone, $klasse, $id);
        if (!$stmt->execute()) {
            echo "Error: <br>" . mysqli_error($this->con);
        }
    }

    public function getStudentsFromClass($id) {
        include_once 'model/Student.php';
        $studentslist = array();
        $res = $this->con->query("SELECT * FROM student WHERE STU_klasse =$id");
        while ($row = $res->fetch_assoc()) {
            $student = new Student($row['PK_Studnr'], $row['STU_name'], $row['STU_vorname'], $row['STU_mail'], $row['STU_telnr'], $row['STU_notiz']);
            $studentslist[] = $student;
        }
        $res->free();
        return $studentslist;
    }

    public function editSchoolclass($id, $classname) {
        $stmt = $this->con->prepare("UPDATE klasse SET KLA_name = ? WHERE PK_Klassenr=?");
        $stmt->bind_param("ss", $classname, $id);
        if (!$stmt->execute()) {
            echo "Error: <br>" . mysqli_error($this->con);
        }
    }
    
    public function addSchoolSubject($subjectName){
        
        
    }
}
