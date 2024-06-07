<?php $lang = isset($_COOKIE['lang']) ? $_COOKIE['lang'] : 'UA';
$translations = include "$lang.php";?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сторінка не знайдена</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
        <h1>404 - <?php echo $translations['Сторінка не знайдена']?></h1>
        <p><?php echo $translations['Вибачте, але сторінка, яку ви шукаєте, не існує.']?></p>
    </main>
</body>
</html>