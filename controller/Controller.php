<?php

/**
 * abstract class for all controllers 
 *
 * @author Marc Jenzer
 */
abstract class Controller {

    protected $resourceId;

    /**
     * Reads collection data from model 
     * and assigns values to dedicated view template
     */
    abstract protected function index();

    /**
     * Reads data of a single resource from model 
     * and assigs values to dedicated view template 
     */
    abstract protected function show();

    /**
     * creates a new empty instance of the resource 
     */
    abstract protected function showNotes();

    /**
     * creates a new empty instance of the resource 
     */
    
    abstract protected function init();

    /**
     * validates and stores sent user data of a newly created resource
     */
    abstract protected function create();

    abstract protected function delete();

    abstract protected function edit();

    public function route() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $matches = array();
                if (preg_match("@^.*/show@", $_SERVER['REQUEST_URI'])) {
                    $this->show();
                } elseif (preg_match("@^.*/notes@", $_SERVER['REQUEST_URI'])) {
                    $this->showNotes();
                } elseif (preg_match("@^.*/new@", $_SERVER['REQUEST_URI'])) {
                    $this->create();
                } elseif (preg_match("@^.*/delete@", $_SERVER['REQUEST_URI'])) {
                    $this->delete();
                    break;
                } elseif (preg_match("@^.*/edit@", $_SERVER['REQUEST_URI'])) {
                    $this->edit();
                    break;
                } else {
                    $this->index();
                }
                break;

            case 'POST':
                if (preg_match("@^.*/edit@", $_SERVER['REQUEST_URI'])) {
                    $this->edit();
                    break;
                } else {
                    $this->create();
                }
                break;

            default:
                break;
        }
    }

}
