<?php

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
        $res = $this->con->query("SELECT * FROM klasse ORDER BY PK_Klassenr");
        while ($row = $res->fetch_assoc()) {
            $class = new SchoolClass($row['PK_Klassenr'], $row['KLA_name'], $row['KLA_notiz']);
            $schoolClassList[] = $class;
        }
        $res->free();
        return $schoolClassList;
    }

    public function addSchoolclass($classname) {
        $sqli = "INSERT INTO klasse (KLA_name) VALUES ('{$classname}')";


        if (mysqli_query($this->con, $sqli)) {
            echo "Ihre Daten wurden erfolgreich erfasst.<br>";
            echo "<a href='URI_VERWALTUNG' class=\"btn btn-default\" role=\"button\">Zurück</a>";
        } else {
            echo "Error: " . $sqli . "<br>" . mysqli_error($this->con);
        }
    }

    public function getStudents() {
        include_once 'model/SchoolClass.php';
        $list = array();
        $res = $this->con->query("SELECT * FROM student LEFT JOIN klasse ON student.STU_klasse=klasse.PK_Klassenr");
        while ($row = $res->fetch_assoc()) {
            $klasse = new SchoolClass($row['PK_Klassenr'], $row['KLA_name'], $row['KLA_notiz']);
            $student = new Student($row['PK_Studnr'], $row['STU_name'], $row['STU_vorname'], $row['STU_mail'], $row['STU_telnr'], $row['STU_notiz'], $klasse);
            $list[] = $student;
        }
        $res->free();
        return $list;
    }

    public function addStudent($firstName, $lastName, $email, $phone) {
        $sqli = "INSERT INTO student (STU_vorname,STU_name,STU_mail,STU_telnr) VALUES ('{$firstName}','{$lastName}','{$email}','{$phone}')";

        if (mysqli_query($this->con, $sqli)) {
            echo "Ihre Daten wurden erfolgreich erfasst.<br>";
            echo "<a href='URI_VERWALTUNG' class=\"btn btn-default\" role=\"button\">Zurück</a>";
        } else {
            echo "Error: " . $sqli . "<br>" . mysqli_error($this->con);
        }
    }

    public function deleteClass($id) {
        $stmt = $this->con->prepare("DELETE FROM klasse WHERE PK_Klassenr=?;");
        $stmt->bind_param("s", $id);
        if (!$stmt->execute()) {
            echo "Error: <br>" . mysqli_error($this->con);
        }
    }

    public function deleteStudent($id) {
        $stmt = $this->con->prepare("DELETE FROM student WHERE PK_Studnr=?;");
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            echo "Error: <br>" . mysqli_error($this->con);
        }
    }

    public function editStudent($id, $first_name, $lastname, $email, $phone) {
        $stmt = $this->con->prepare("UPDATE student SET STU_name = ?, STU_vorname = ?, STU_mail = ?, STU_telnr = ? WHERE PK_Studnr = ?");
        $stmt->bind_param("sssii", $first_name,$lastname,$email,$phone,$id);
        if (!$stmt->execute()) {
            echo "Error: <br>" . mysqli_error($this->con);
        }
    }

}
