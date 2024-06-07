<?php $lang = isset($_COOKIE['lang']) ? $_COOKIE['lang'] : 'UA';
$translations = include "$lang.php";
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>?Майстерня</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>

<div class="container">
        <div class="card" data-url="/workshop" onclick="showDescription(this)">
            <!--<img src="category1.jpg" alt="Category 1">-->
            <div>
                <h3>Коштовності та магічні предмети</h3>
            </div>
        </div>
        <!--
        <div class="card" onclick="showDescription(this)">
            <img src="category2.jpg" alt="Category 2">
            <div>
                <h3>Категорія 2</h3>
            </div>
        </div>
-->

    <script>
        function showDescription(card) {
            card.classList.add('expanded');
        }
        function showDescription(element) {
            var url = element.getAttribute('data-url');
            window.location.href = url;
        }
    </script>