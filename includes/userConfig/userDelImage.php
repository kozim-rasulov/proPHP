<?
include_once "../db.php";

$result = userDelImage($_GET['id']);
if ($result) {
    header('Location: ../../?route=userEdit');
} else {
    header('Location: ../../?route=userEdit&error=delImg');
}