<?

function db()
{
    $dbhost = "127.0.0.1";
    $dbname = "tue1930";
    $dblogin = "root";
    $dbpass = "";
    return new PDO("mysql:host=$dbhost;dbname=$dbname", $dblogin, $dbpass);
}

function userReg($login, $pass, $name, $path)
{
    $login = strip_tags($login);
    $name = strip_tags($name);
    $pass = password_hash($pass, PASSWORD_BCRYPT);
    $pdo = db();
    $query = "INSERT INTO `users`(`user_login`, `user_pass`, `user_name`) VALUES (?,?,?)";
    $pdoStat = $pdo->prepare($query);
    $result = $pdoStat->execute([$login, $pass, $name]);
    if ($result) {
        $userId = $pdo->lastInsertId();
        $query = "INSERT INTO `images`(`img_path`, `user_id`, `img_select`) VALUES (?,?,?)";
        $pdoStat = $pdo->prepare($query);
        $pdoStat->execute([$path, $userId, 1]);
    }
    return $result;
}

function userLogin($login, $pass)
{
    $login = strip_tags($login);
    $pdo = db();
    $query = "SELECT `user_id`, `user_login`, `user_pass` FROM `users` WHERE `user_login`=?";
    $pdoStat = $pdo->prepare($query);
    $pdoStat->execute([$login]);
    $user = $pdoStat->fetch(PDO::FETCH_ASSOC);
    if ($login === $user['user_login'] && password_verify($pass, $user['user_pass'])) {
        session_start();
        $_SESSION['id'] = $user['user_id'];
        return true;
    };
    return false;
};

function userInfo()
{
    session_start();
    $userId = $_SESSION['id'];
    $pdo = db();
    $query = "SELECT `user_login`, `user_name`, images.img_path FROM `users` JOIN `images` USING(`user_id`) WHERE `users`.`user_id`=? AND `images`.`img_select`=?";
    $pdoStat = $pdo->prepare($query);
    $pdoStat->execute([$userId, 1]);
    return $pdoStat->fetch(PDO::FETCH_ASSOC);
}

function userAddImage($path)
{
    session_start();
    $userId = $_SESSION['id'];
    $pdo = db();
    $query = "INSERT INTO `images`(`img_path`, `user_id`) VALUES (?,?)";
    $pdoStat = $pdo->prepare($query);
    return $pdoStat->execute([$path, $userId]);
}
function userGetImages()
{
    session_start();
    $userId = $_SESSION['id'];
    $pdo = db();
    $query = "SELECT `img_id`, `img_path`, `user_id`, `img_select` FROM `images` WHERE `user_id`=?";
    $pdoStat = $pdo->prepare($query);
    $pdoStat->execute([$userId]);
    return $pdoStat->fetchAll(PDO::FETCH_ASSOC);
}
function userChangeAva($imgId)
{
    session_start();
    $userId = $_SESSION['id'];
    $pdo = db();
    $query = "UPDATE `images` SET `img_select`= 0 WHERE `user_id` = ?";
    $pdoStat = $pdo->prepare($query);
    $result = $pdoStat->execute([$userId]);
    if ($result) {
        $query = "UPDATE `images` SET `img_select`= 1 WHERE `user_id` = ? AND `img_id`= ?";
        $pdoStat = $pdo->prepare($query);
        return $pdoStat->execute([$userId, $imgId]);
    }
}
function userDelImage($imgId)
{
    session_start();
    $userId = $_SESSION['id'];
    $pdo = db();
    $query = "SELECT `img_select`, `img_path` FROM `images` WHERE `user_id`=? AND `img_id`=?";
    $pdoStat = $pdo->prepare($query);
    $pdoStat->execute([$userId, $imgId]);
    $user = $pdoStat->fetch(PDO::FETCH_ASSOC);
    if ($user['img_select'] != 1) {
        unlink("../../{$user['img_path']}");
        $query = "DELETE FROM `images` WHERE `user_id`=? AND `img_id`=?";
        $pdoStat = $pdo->prepare($query);
        return $pdoStat->execute([$userId, $imgId]);
    } else {
        return false;
    }
}
function userAddComment($time, $text, $userId)
{
    $pdo = db();
    $query = "INSERT INTO `comment`(`comment_time`, `comment_text`, `user_id`) VALUES (?,?,?)";
    $pdoStat = $pdo->prepare($query);
    return $pdoStat->execute([$time, $text, $userId]);
}
function getAllComments()
{
    $pdo = db();
    $query = "SELECT `comment_id`, `comment_time`, `comment_text`, `images`.`img_path`, `users`.`user_name`, `user_id` FROM `comment` JOIN `images` USING(`user_id`) JOIN `users` USING(`user_id`) WHERE `images`.`img_select`=1 ORDER BY `comment_time`";
    $pdoStat = $pdo->prepare($query);
    $pdoStat->execute();
    return $pdoStat->fetchAll(PDO::FETCH_ASSOC);
}
function editCommentInfo($commId)
{
    session_start();
    $userId = $_SESSION['id'];
    $pdo = db();
    $query = "SELECT `comment_id`, `comment_text`, `user_id` FROM `comment` WHERE `comment_id`=? AND `user_id`=?";
    $pdoStat = $pdo->prepare($query);
    $pdoStat->execute([$commId, $userId]);
    return $pdoStat->fetch(PDO::FETCH_ASSOC);
}
function userEditComment($text, $commId, $userId)
{
    $pdo = db();
    $query = "UPDATE `comment` SET `comment_text`=? WHERE `comment_id`=? AND `user_id`=?";
    $pdoStat = $pdo->prepare($query);
    return $pdoStat->execute([$text, $commId, $userId]);
}
function userDelComment($commId, $userId)
{
    $pdo = db();
    $query = "DELETE FROM `comment` WHERE `comment_id`=? AND `user_id`=?";
    $pdoStat = $pdo->prepare($query);
    return $pdoStat->execute([$commId, $userId]);
}
