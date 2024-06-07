<?php $lang = isset($_COOKIE['lang']) ? $_COOKIE['lang'] : 'UA';
$translations = include "$lang.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <style>
        
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
    
</body>
</html>
