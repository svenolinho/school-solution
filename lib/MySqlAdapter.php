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
    private $error;

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
            if($stmt->errno == 1451){
                if(preg_match("@student@i", $stmt->error)) {
                    return MySqlResult::ClassDeleteStudentError;
                }
                if(preg_match("@pruefungen@i", $stmt->error)) {
                    return MySqlResult::ClassDeleteExamsError;
                }
            }
            return MySqlResult::Unexpected;
        }
        return MySqlResult::Ok;
    }
    
    public function getError(){
        return $this->error;
    }

    public function deleteStudent($id) {
        $stmt = $this->con->prepare("DELETE FROM student WHERE PK_Studnr=?;");
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            echo "Error: <br>" . mysqli_error($this->con);
        }
    }

    public function editStudent($id, $firstname, $lastname, $email, $phone, $klasse = NULL, $note) {
        if ($note == NULL) {
            $stmt = $this->con->prepare("UPDATE student SET STU_name = ?, STU_vorname = ?, STU_mail = ?, STU_telnr = ?, STU_klasse = ? WHERE PK_Studnr = ?");
            $stmt->bind_param("sssssi", $lastname, $firstname, $email, $phone, $klasse, $id);
        } else if ($note == !NULL) {
            $stmt = $this->con->prepare("UPDATE student SET STU_notiz = ? WHERE PK_Studnr = ?");
            $stmt->bind_param("si", $note, $id);
        }

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

    public function getExamsFromSubjects($id) {
        include_once 'model/Exam.php';
        $examlist = array();
        $res = $this->con->query("SELECT * FROM pruefungen WHERE PRUEF_fach =$id");
        while ($row = $res->fetch_assoc()) {
            $exam = new Exam($row['PK_Pruefnr'], $row['PRUEF_fach'], $row['PRUEF_klasse'], $row['PRUEF_notenschluessel'], $row['PRUEF_datum'], $row['PRUEF_maxpunktzahl']);
            $examlist[] = $exam;
        }
        $res->free();
        return $examlist;
    }

    public function getStudent($id) {
        include_once 'model/Student.php';
        include_once 'view/studenten/StudentsListView.php';
        $res = $this->con->query("SELECT * FROM student WHERE PK_Studnr = $id");
        if (($row = $res->fetch_assoc())) {
            $student = new Student($row['PK_Studnr'], $row['STU_name'], $row['STU_vorname'], $row['STU_mail'], $row['STU_telnr'], $row['STU_notiz']);
        }
        $res->free();
        return $student;
    }

    public function getExam($id) {
        include_once 'model/Exam.php';
        include_once 'view/pruefungen/ExamView.php';
        $res = $this->con->query("SELECT * FROM pruefungen WHERE PK_Pruefnr = $id");
        if (($row = $res->fetch_assoc())) {
            $exam = new Exam($row['PK_Pruefnr'], $row['PRUEF_fach'], $row['PRUEF_klasse'], $row['PRUEF_notenschluessel'], $row['PRUEF_datum'], $row['PRUEF_maxpunktzahl'], $row['PRUEF_notiz']);
        }
        $res->free();
        return $exam;
    }

    public function getSchoolClass($id) {
        include_once 'model/SchoolClass.php';
        include_once 'view/klassen/ClassListView.php';
        $res = $this->con->query("SELECT * FROM klasse WHERE PK_Klassenr = $id");
        if (($row = $res->fetch_assoc())) {
            $schoolClass = new SchoolClass($row['PK_Klassenr'], $row['KLA_name'], $row['KLA_notiz']);
        }
        $res->free();
        return $schoolClass;
    }

    public function editSchoolclass($id, $classname, $note) {
        if ($note == NULL) {
            $stmt = $this->con->prepare("UPDATE klasse SET KLA_name = ? WHERE PK_Klassenr=?");
            $stmt->bind_param("si", $classname, $id);
        } else if ($note == !NULL) {
            $stmt = $this->con->prepare("UPDATE klasse SET KLA_notiz = ? WHERE PK_Klassenr=?");
            $stmt->bind_param("si", $note, $id);
        }
        if (!$stmt->execute()) {
            echo "Error: <br>" . mysqli_error($this->con);
        }
    }

    public function addSchoolSubject($subjectName) {
        $stmt = $this->con->prepare("INSERT INTO fach (FACH_name) VALUES (?)");
        $stmt->bind_param("s", $subjectName);

        if ($stmt->execute()) {
            
        } else {
            echo "Error: <br>" . mysqli_error($this->con);
        }
    }

    public function editSchoolSubject($id, $subjectName) {
        $stmt = $this->con->prepare("UPDATE fach SET FACH_name = ? WHERE PK_Fachnr=?");
        $stmt->bind_param("ss", $subjectName, $id);
        if (!$stmt->execute()) {
            echo "Error: <br>" . mysqli_error($this->con);
        }
    }

    public function deleteSchoolSubject($id) {
        $stmt = $this->con->prepare("DELETE FROM fach WHERE PK_Fachnr=?;");
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            $error = new Error();
            $error->displaySubjectDeleteError();
        }
    }

    public function getSchoolSubjects() {
        $schoolSubjects = array();
        $res = $this->con->query("SELECT * FROM fach ORDER BY FACH_name");
        while ($row = $res->fetch_assoc()) {
            $subject = new SchoolSubject($row['PK_Fachnr'], $row['FACH_name']);
            $schoolSubjects[] = $subject;
        }
        $res->free();
        return $schoolSubjects;
    }

    public function addExam($subject, $schoolClass, $clef, $date, $maxScore) {
        $stmt = $this->con->prepare("INSERT INTO pruefungen (PRUEF_fach,PRUEF_klasse,PRUEF_notenschluessel,PRUEF_datum,PRUEF_maxPunktzahl) VALUES (?,?,?,?,?)");
        $stmt->bind_param("iissd", $subject, $schoolClass, $clef, $date, $maxScore);

        if ($stmt->execute()) {
            
        } else {
            echo "Error: <br>" . mysqli_error($this->con);
        }
    }

    public function getExams() {
        $exams = array();
        $res = $this->con->query("SELECT * FROM pruefungen LEFT JOIN fach ON PRUEF_fach = fach.PK_Fachnr LEFT JOIN klasse ON PRUEF_klasse = klasse.PK_Klassenr ORDER BY PRUEF_datum");
        while ($row = $res->fetch_assoc()) {
            $subject = new SchoolSubject($row['PK_Fachnr'], $row['FACH_name']);
            $class = new SchoolClass($row['PK_Klassenr'], $row['KLA_name'], $row['KLA_notiz']);
            $exam = new Exam($row['PK_Pruefnr'], $subject, $class, $row['PRUEF_notenschluessel'], $row['PRUEF_datum'], $row['PRUEF_maxpunktzahl']);
            $exams[] = $exam;
        }
        $res->free();
        return $exams;
    }

    public function deleteExam($id) {
        $stmt = $this->con->prepare("DELETE FROM pruefungen WHERE PK_Pruefnr=?;");
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            $error = new Error();
            $error->displaySubjectDeleteError();
        }
    }

    public function editExam($id, $subject, $schoolClass, $clef, $date, $maxScore, $note) {
        if ($note == NULL) {
            $stmt = $this->con->prepare("UPDATE pruefungen SET PRUEF_fach = ?, PRUEF_klasse = ?, PRUEF_notenschluessel = ?, PRUEF_datum = ?, PRUEF_maxPunktzahl = ? WHERE PK_Pruefnr=?");
            $stmt->bind_param("iissdi", $subject, $schoolClass, $clef, $date, $maxScore, $id);
        } else if ($note == !NULL) {
            $stmt = $this->con->prepare("UPDATE pruefungen SET PRUEF_notiz = ? WHERE PK_Pruefnr=?");
            $stmt->bind_param("si", $note, $id);
        }

        if (!$stmt->execute()) {
            echo "Error: <br>" . mysqli_error($this->con);
        }
    }

    public function updateExamNote($id,$note){
        $stmt = $this->con->prepare("UPDATE pruefungen SET PRUEF_notiz = ? WHERE PK_Pruefnr=?");
        $stmt->bind_param("si", $note, $id);
        if (!$stmt->execute()) {
            echo "Error: <br>" . mysqli_error($this->con);
        }
    }

}
