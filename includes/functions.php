<?
date_default_timezone_set('Asia/Tashkent');
$route = $_GET['route'] ?? 'home';
$route = is_readable("./page/$route.php") ? $route : '404';

$page = [
    'home' => ['name' => 'Главная', 'icon' => 'fal fa-home'],
    'contact' => ['name' => 'Контакты', 'icon' => 'fal fa-address-book'],
    'table' => ['name' => 'Таблица умножения', 'icon' => 'fas fa-times'],
    'calc' => ['name' => 'Калькулятор', 'icon' => 'fas fa-calculator-alt'],
    'slide' => ['name' => 'Слайдер', 'icon' => 'far fa-presentation'],
    'guest' => ['name' => 'Гостевая книга', 'icon' => 'fal fa-books'],
    'login' => ['name' => 'Вход в систему'],
    'registration' => ['name' => 'Регистрация'],
];
$title = $page[$route]['name'];

$ruMonths = ["Январ", "Февраль", "Март", "Апрель", "Март", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"];
$ruMonth = $ruMonths[date('n') - 1];
$date = date("Сегодня d $ruMonth o год");
