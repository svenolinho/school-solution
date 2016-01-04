<?php
include_once 'config/config.php';

$administrationUri = 'URI_VERWALTUNG'
?>

<div id = schoolclassForm>
    <form action = "<?php $administrationUri ?>" method = "post"/>

    <label for = "schoolclassForm-class_name">Klassenname</label>
    <input type = "text" id = "schoolclassForm-class_name" name = "class_name">

    <input type = "submit" name = "schoolclassForm_submit" value = "Speichern">
    </form>
</div>
