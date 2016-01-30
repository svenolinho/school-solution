<?php
include_once 'lib/MySqlResult.php';
/**
 * abstract class for all views 
 *
 * @author Marc Jenzer
 */
abstract class View {

    protected $vars = array();
    protected $note;

    public function assign1($key, $value) {
        $this->vars[$key] = $value;
    }

    public function assign2($key, $value) {
        $this->vars[$key] = $value;
    }

    abstract function display();
}
