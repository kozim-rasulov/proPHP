<?
include_once "../db.php";

$result = userChangeAva($_POST['photo']);
if ($result) {
    header('Location: ../../?route=userEdit');
} else {
    header('Location: ../../?route=userEdit&error=change');
}