<?
include_once "../db.php";
session_start();
$userId = $_SESSION['id'];
$commId = $_GET['commId'];
$result = userDelComment($commId, $userId);
if ($result) {
    header('Location: ../../?route=guest');
} else {
    header('Location: ../../?route=guest&error=commentDel');
}
