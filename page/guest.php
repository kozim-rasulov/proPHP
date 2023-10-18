<main class="main">
    <section class="head">
        <h2 class="head__title"><?= $title ?></h2>
        <p class="head__date"><?= $date ?></p>
    </section>
    <? if ($_GET['error'] === 'notAuth') : ?>
        <p style="color: red;">Вы не авторизованы. Пожалуйста выполните вход или зарегистрируйтесь.</p>
    <? elseif ($_GET['error'] === 'db') : ?>
        <p style="color: red;">Произошла ошибка при отправке отзыва !!!</p>
    <? endif; ?>
    <form action="<?= isset($_GET['editComm']) ? './includes/userConfig/userEditComment.php?editComm='.$_GET['editComm'] : './includes/userConfig/userAddComment.php' ?>" class="form" method="post">
        <label class="form__label">
            <span class="form__text"><?= isset($_GET['editComm']) ? 'Редактировать отзыв' : 'Оставте отзыв' ?></span>
            <textarea class="form__input" name="descr"><?= $editComment['comment_text'] ?></textarea>
        </label>
        <button class="form__btn"><?= isset($_GET['editComm']) ? 'Изменить' : 'Отправить' ?></button>
        <? if (isset($_GET['editComm'])) : ?>
            <a href="?route=guest" class="form__btn">Отменить</a>
        <? endif; ?>
    </form>
    <div class="comments">
        <? foreach ($comments as $key => $value) : ?>
            <div class="comments__item">
                <p class="comments__item-time"><?= date('H:i d/m/o', $value['comment_time']) ?></p>
                <section class="comments__body">
                    <div class="comments__head">
                        <h2 class="comment__head-title"><?= $value['user_name'] ?></h2>
                        <img src="<?= $value['img_path'] ?>" alt="" class="comments__head-img">
                    </div>
                    <p class="comments__body-descr">
                        <?= $value['comment_text'] ?>
                    </p>

                    <? if ($_SESSION['id'] == $value['user_id']) : ?>
                        <div class="comments__footer">
                            <a href="?route=guest&editComm=<?= $value['comment_id'] ?>" class="comments__footer-link"><i class="fal fa-edit"></i></a>
                            <a href="./includes/userConfig/userDelComment.php?commId=<?=$value['comment_id']?>" class="comments__footer-link"><i class="fal fa-trash"></i></a>
                        </div>
                    <? endif; ?>

                </section>
            </div>

        <? endforeach; ?>
    </div>
</main>