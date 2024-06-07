<?php $lang = isset($_COOKIE['lang']) ? $_COOKIE['lang'] : 'UA';
$translations = include "$lang.php";?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Реєстрація</title>
    <link rel="stylesheet" href="public/css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 1em 0;
            text-align: center;
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        nav ul li {
            display: inline;
            margin-right: 10px;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            background-color: #4CAF50;
            border-radius: 4px;
        }
        nav ul li a:hover {
            background-color: #45a049;
        }
        #language-form {
            margin-top: 10px;
        }
        #language-form select {
            padding: 5px;
        }
        #language-form input[type="submit"] {
            padding: 5px 10px;
            background-color: white;
            color: #4CAF50;
            border: 1px solid #4CAF50;
            border-radius: 4px;
            cursor: pointer;
        }
        #language-form input[type="submit"]:hover {
            background-color: #f1f1f1;
        }
        main {
            padding: 2em;
            text-align: center;
        }
        h1 {
            color: #4CAF50;
        }
        form {
            background-color: white;
            padding: 20px;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: inline-block;
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            color: #555;
        }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>

</head>
<body>
<header>
        <nav>
            <ul>
                <li><a href="/"><?php echo $translations['Головна']?></a></li>
                <li><a href="/guide"><?php echo $translations['Довідник']?></a></li>
                <li><a href="/workshop_hub"><?php echo $translations['Майстерня Майстра']?></a></li>
                <li><a href="/account"><?php echo $translations['Аккаунт']?></a></li>
                <li><a href="/logout"><?php echo $translations['Вихід']?></a></li>
            </ul>
        </nav>
        <form action="change_language.php" method="get" id="language-form">
            <select name="lang" id="lang-select">
                <option value="ua" <?php if($lang == 'ua') echo "selected" ?> >Українська</option>
                <option value="en" <?php if($lang == 'en') echo "selected" ?>>English</option> 
            </select>
            <input type="submit" value="Switch Language">
        </form>
    </header>
    <main> 
        <h1><?php echo $translations['Реєстрація']?></h1>
        <form action="/register" method="post">
            <label for="username"><?php echo $translations['Ім\'я користувача']?>:</label>
            <input type="text" id="username" name="username" required>
            <label for="email"><?php echo $translations['Електрона пошта']?>:</label>
            <input type="email" id="email" name="email" required>
            <label for="password"><?php echo $translations['Пароль']?>:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit"><?php echo $translations['Зареєструватися']?></button>
        </form>
    </main>
</body>
</html>