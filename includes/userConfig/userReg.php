<?
include_once "../db.php";
$user = $_POST;
$photo = $_FILES['photo'];

$rand_name = md5(time());
$extension = pathinfo($photo['name'], PATHINFO_EXTENSION);
$file_name = "{$user['login']}-$rand_name.$extension";
$file_name = is_uploaded_file($photo['tmp_name']) ? $file_name : 'default.jpg';
$dir_name = "./img/users/$file_name";

$result = userReg($user['login'], $user['pass'], $user['name'], $dir_name);
if ($result) {
    if (is_uploaded_file($photo['tmp_name'])) {
        move_uploaded_file($photo['tmp_name'], "../../$dir_name");
    };
    header('Location: ../../?route=login');
} else {
    header('Location: ../../?route=registration&error=reg');
}
