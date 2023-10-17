<?
include_once "../db.php";
$user = userInfo()['user_login'];
$photo = $_FILES['photo'];

foreach ($photo['name'] as $key => $value) {
    $rand_name = md5(time()) . crc32($key);
    $extension = pathinfo($value, PATHINFO_EXTENSION);
    $file_name = "$user-$rand_name.$extension";
    $dir_name = "./img/users/$file_name";
    if (is_uploaded_file($photo['tmp_name'][$key])) {
        $result = userAddImage($dir_name);
        if ($result) {
            move_uploaded_file($photo['tmp_name'][$key], "../../$dir_name");
        }
    }
}
header('Location: ../../?route=userEdit');