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
