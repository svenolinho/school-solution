<?php
include_once 'config/config.php';
$controller = null;
switch (getCurrentURI()) {
    case URI_PRUEFUNGEN:
        include_once 'rest/controller/ExamRestController.php';
        $controller = new ExamRestController();
        break;
    case URI_AUSWERTUNG:
        include_once 'rest/controller/EvaluationRestController.php';
        $controller = new EvaluationRestController();
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
        URI_AUSWERTUNG => 'Auswertung',
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
            if (preg_match("@^/rest$href@", $_SERVER['REQUEST_URI'])) {
                return $href;
            }
        }
    }
    return key($menu);
}

?>