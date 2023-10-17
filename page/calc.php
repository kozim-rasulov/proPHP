<main class="main">
    <section class="head">
        <h2 class="head__title"><?= $title ?></h2>
        <p class="head__date"><?= $date ?></p>
    </section>
    <form action="" class="form" method="post">
        <label class="form__label">
            <span class="form__text">Число 1</span>
            <input type="text" class="form__input" name="one" data-type="number">
        </label>
        <div class="form__mySelect">
            <div class="form__select">
                <div class="form__select-name">Выбирите знак</div>
                <div class="form__select-option">

                </div>
            </div>
            <select name="symbol">
                <option value="+">+</option>
                <option value="-">-</option>
                <option value="*">*</option>
                <option value="/">/</option>
            </select>
        </div>
        <label class="form__label">
            <span class="form__text">Число 2</span>
            <input type="text" class="form__input" name="two" data-type="number">
        </label>
        <button class="form__btn">Посчитать</button>

        <?
        $one = $_POST['one'];
        $symbol = $_POST['symbol'];
        $two = $_POST['two'];
        switch ($symbol) {
            case '+':
                $result = $one + $two;
                break;
            case '-':
                $result = $one - $two;
                break;
            case '*':
                $result = $one * $two;
                break;
            case '/':
                $result = $one / $two;
                break;
        };
        echo "<br><br>";
        echo "<h3>$one $symbol $two = $result</h3>";
        ?>
    </form>
</main>