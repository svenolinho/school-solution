<?php
include_once 'config/config.php';

$administrationUri = 'URI_VERWALTUNG'
?>

<div id = studentform>
    <form action = "<?php $administrationUri ?>" method = "post"/>
    <label for = "contactform-first_name">Vorname</label>
    <input type = "text" id = "contactform-first_name" name = "first_name">

    <label for = "contactform-lastname">Name</label>
    <input type = "text" id = "contactform-lastname" name = "lastname">

    <label for = "contactform-email" class = "required">Email-Adresse</label>
    <input type = "email" id = "contactform-email" name = "email" required>

    <label for = "contactform-phone">Telefon-Nr.</label>
    <input type = "tel" id = "contactform-phone" name = "phone">

    <input type = "submit" name = "contactform_submit" value = "Speichern">
    </form>
</div>

