<?php

include_once 'rest/controller/RestController.php';
include_once 'model/Exam.php';

class ExamRestController extends RestController
{

    protected function get()
    {
        header("Content-Type: application/javascript");
        $clef = filter_input(INPUT_GET, 'clef', FILTER_DEFAULT);
        if (Exam::isValidClef($clef)) {
            http_response_code(200);
        } else {
            http_response_code(400);
        }
    }

    protected function post()
    {
        // empty
    }
}