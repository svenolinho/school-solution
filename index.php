<!DOCTYPE html>
<?php
include_once 'config/config.php';
?>

<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="School Solution ist eine Webapplikation für eine umfassende Verwaltung der Klausur-Resultate.">
        <meta name="author" content="Gruppe NoName">

        <title>School Solution</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" >
        <link rel="stylesheet" type="text/css" href="/css/bootstrap-theme.min.css" >
        <link rel="stylesheet" type="text/css" href="/css/application.css">

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script type="text/javascript" src="/js/bootstrap.min.js"></script>

    </head>

    <body>
        <!-- Header -->
        <div  id="header"  class="container">
            <div id="logo">
                <a href="/home"><img src="/images/SchoolSolution_trans.gif" alt="School Solution Logo"/></a>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="navbar navbar-default" role="navigation">
            <div class="container">
                <ul class="nav navbar-nav">
                    <?php
                    $currentUri = getCurrentURI();
                    foreach (getMenu() as $href => $title) {
                        echo "<li " . (($href == $currentUri) ? "class=\"active\" " : "") . "><a href=\"$href\">$title</a></li>\n";
                    }
                    ?>
                </ul>
            </div>
        </nav>

        <!-- Content -->
        <div class="container">
            <?php
            $controller = null;
            switch (getCurrentURI()) {
                case URI_HOME:
                    include_once 'view/home/bedienungsanleitung.php';
                    break;

                case URI_KLASSEN:
                    include_once 'controller/SchoolClassController.php';
                    $controller = new SchoolClassController();
                    break;

                case URI_STUDENTEN:
                    include_once 'controller/StudentController.php';
                    $controller = new StudentController();
                    break;

                case URI_FAECHER:
                    echo "Fächer";
                    break;
                
                case URI_PRUEFUNGEN:
                    echo "Prüfungen";
                    break;

                case URI_AUSWERTUNG:
                    echo "auswertung";
                    break;
            }
            if ($controller != null) {
                $controller->route();
            }
            ?>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">   
                <p class="text-muted">Copyright © 2015 School-Solution</p>
            </div>
        </footer>

    </body>
</html>

<?php

/**
 * @return array containing all menu items in format [base href] => [title]
 */
function getMenu() {
    return array(
        URI_HOME => 'Home',
        URI_KLASSEN => 'Klassen',
        URI_STUDENTEN => 'Studenten',
        URI_FAECHER => 'Fächer',
        URI_PRUEFUNGEN => 'Prüfungen',
        URI_AUSWERTUNG => 'Auswertung',
    );
}

/**
 * @return string the requested menu item URI
 */
function getCurrentURI() {
    $menu = getMenu();
    if (array_key_exists($_SERVER['REQUEST_URI'], $menu)) {
        return $_SERVER['REQUEST_URI'];
    } else {
        foreach (array_keys(getMenu()) as $href) {
            if (preg_match("@^$href@", $_SERVER['REQUEST_URI'])) {
                return $href;
            }
        }
    }
    return key($menu);
}
?>