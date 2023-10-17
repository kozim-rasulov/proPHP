<main class="main">
    <section class="head">
        <h2 class="head__title"><?= $title ?></h2>
        <p class="head__date"><?= $date ?></p>
    </section>
    <form action="" class="form" method="post">
        <label class="form__label">
            <span class="form__text">Количество колонок</span>
            <input type="text" class="form__input" name="col">
        </label>
        <label class="form__label">
            <span class="form__text">Количество строк</span>
            <input type="text" class="form__input" name="row">
        </label>
        <button class="form__btn">Отправить</button>
    </form>

    <div class="table">

        <?
        $rows = $_POST['row'];
        $cols = $_POST['col'];
        ?>

        <? for ($i = 1; $i <= $rows; $i++) : ?>

            <div class="table__row">
                <? for ($x = 1; $x <= $cols; $x++) : ?>
                    <div class="table__col">
                        <?= $i * $x ?>
                    </div>
                <? endfor; ?>
            </div>
        <? endfor; ?>

    </div>


</main>