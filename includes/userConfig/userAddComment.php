<?
include_once "../db.php";
session_start();

if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
    $descr = htmlspecialchars($_POST['descr']);
    $time = time();
    $result = userAddComment($time, $descr, $userId);
    if ($result) {
        header('Location: ../../?route=guest');
    } else {
        header('Location: ../../?route=guest&error=db');
    }
} else {
    header('Location: ../../?route=guest&error=notAuth');
}
