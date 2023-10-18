<?
include_once "../db.php";
session_start();
$userId = $_SESSION['id'];
$descr = htmlspecialchars($_POST['descr']);
$commentId = $_GET['editComm'];
$result = userEditComment($descr, $commentId, $userId);
if ($result) {
    header('Location: ../../?route=guest');
} else {
    header('Location: ../../?route=guest&error=commentEdit');
}
