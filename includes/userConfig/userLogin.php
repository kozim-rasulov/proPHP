<?
include_once "../db.php";

$result = userLogin($_POST['login'], $_POST['pass']);
if ($result) {
    header('Location: ../../?route=home');
} else {
    header('Location: ../../?route=login&error=login');
}
