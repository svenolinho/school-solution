<?php

abstract class RestController
{
    abstract protected function get();

    abstract protected function post();

    public function route() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $this->get();
                break;
            case 'POST':
                $this->post();
                break;
            default:
                http_response_code(404);
                break;
        }
    }
}