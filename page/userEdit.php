<? if (isset($_SESSION['id'])) : ?>
    <main class="main">
        <section class="head">
            <h2 class="head__title"><?= $userInfo['user_login'] ?></h2>
            <p class="head__date"><?= $date ?></p>
        </section>
        <?if ($_GET['error'] == 'delImg') :?>
            <p style="color: red; margin-bottom: 15px">Нельзя удалить аватарку</p>
        <?endif;?>
        <form action="./includes/userConfig/userChangeAva.php" class="userImage" method="post">
            <div class="userImage__wrapper">
                <? foreach ($userImages as $key => $value) : ?>
                    <label class="userImage__label">
                        <img src="<?= $value['img_path'] ?>" alt="" class="userImage__img">
                        <input type="radio" name="photo" value="<?= $value['img_id'] ?>" class="userImage__input" hidden>
                        <span class="userImage__check <?=$value['img_select'] == 1 ? 'userImage__check-active' : ''?>">
                            <i class="fas fa-check userImage__icon <?=$value['img_select'] == 1 ? 'userImage__icon-active' : ''?>"></i>
                        </span>
                        <a href="./includes/userConfig/userDelImage.php?id=<?= $value['img_id'] ?>" class="userImage__trash">
                            <i class="fas fa-trash userImage__icon"></i>
                        </a>
                    </label>
                <? endforeach; ?>
            </div>
            <button class="form__btn userImage__btn">Изменить аватарку</button>

        </form>

        <form action="./includes/userConfig/userAddImage.php" method="post" class="userAddImage" enctype="multipart/form-data">
            <h3>Добавить фотографию</h3>
            <input type="file" name="photo[]" accept=".jpg, .jpeg, .png" multiple>
            <button class="form__btn">Отправить</button>
        </form>
    </main>
<? else : ?>
    <script>
        window.location = '?route=404'
    </script>
<? endif; ?>