<?php $lang = isset($_COOKIE['lang']) ? $_COOKIE['lang'] : 'UA';
$translations = include "$lang.php";?>



<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вхід</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<header>
        <nav>
            <ul>
                <li><a href="/"><?php echo $translations['Головна']?></a></li>
                <li><a href="/guide"><?php echo $translations['Довідник']?></a></li>
                <li><a href="/workshop_hub"><?php echo $translations['Майстерня Майстра']?></a></li>
                <li><a href="/account"><?php echo $translations['Аккаунт']?></a></li>
                <li><a href="/register"><?php echo $translations['Реєстрація']?></a></li>
                <li><a href="/logout"><?php echo $translations['Вихід']?></a></li>
            </ul>
        </nav>
        <form action="change_language.php" method="get" id="language-form">
            <select name="lang" id="lang-select">
                <option value="ua" <?php if($lang == 'ua') echo "selected" ?> >Українська</option>
                <option value="en" <?php if($lang == 'en') echo "selected" ?>>English</option> 
            </select>
            <input type="submit" value="<?php echo $translations['Змінити мову']?>">
        </form>
    </header>
    <main>
        <h1><?php echo $translations['Вхід']?></h1>
        <form action="/login" method="post">
            <label for="username">Ім'я користувача:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Увійти</button>
        </form>
    </main>
</body>
</html>