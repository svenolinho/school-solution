<?php
include_once 'config/config.php';
$controller = null;
switch (getCurrentURI()) {
    case URI_PRUEFUNGEN:
        include_once 'rest/controller/ExamRestController.php';
        $controller = new ExamRestController();
        break;
    default:
        exit;
}
if ($controller != null) {
    $controller->route();
}

/**
 * @return array containing all menu items in format [base href] => [title]
 */
function getResource()
{
    return array(
        URI_PRUEFUNGEN => 'Prüfungen',
    );
}

/**
 * @return string the requested menu item URI
 */
function getCurrentURI()
{
    $menu = getResource();
    if (array_key_exists($_SERVER['REQUEST_URI'], $menu)) {
        return $_SERVER['REQUEST_URI'];
    } else {
        foreach (array_keys(getResource()) as $href) {
            if (preg_match("@^$href@", $_SERVER['REQUEST_URI'])) {
                return $href;
            }
        }
    }
    return key($menu);
}

?>