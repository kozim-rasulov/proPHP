<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/all.css">
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <div class="wrap">
        <header class="header">
            <a href="/" class="logo">PROWEB</a>
            <? if (!isset($_SESSION['id'])) : ?>

                <div class="singIn">
                    <a href="/?route=login" class="singIn__link">Вход</a>
                    <a href="/?route=registration" class="singIn__link">Регистрация</a>
                </div>

            <? else : ?>

                <div class="user">
                    <div class="user__profile">
                        <img src="<?= $userInfo['img_path'] ?>" alt="" class="user__profile-img">
                        <h4 class="user__profile-name"><?= $userInfo['user_name'] ?></h4>
                    </div>
                    <ul class="user__menu">
                        <li>
                            <a href="?route=userEdit" class="user__menu-link">
                                <i class="far fa-external-link"></i>
                                Настройка
                            </a>
                        </li>
                        <li>
                            <a href="./includes/userConfig/userLogOut.php" class="user__menu-link">
                                <i class="far fa-external-link"></i>
                                Выход
                            </a>
                        </li>
                    </ul>
                </div>

            <? endif; ?>
        </header>