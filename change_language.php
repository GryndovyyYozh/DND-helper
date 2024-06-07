<?php
if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];

    // Збережіть мову у cookies або сесії для подальшого використання
    setcookie('lang', $lang, time() + (86400 * 30), "/"); // Наприклад, зберігаємо у cookies
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>