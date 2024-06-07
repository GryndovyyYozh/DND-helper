<?php $lang = isset($_COOKIE['lang']) ? $_COOKIE['lang'] : 'UA';
$translations = include "$lang.php"; ?>

</main>
<footer>
    <p>Загальна кількість переглядів: <?php echo getPageViews($conn); ?></p>
</footer>
</body>
</html>

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f0f4f8;
        color: #333;
        margin: 0;
        padding: 0;
    }
    footer {
        background-color: #3b5998;
        color: white;
        padding: 1em 0;
        text-align: center;
        position: fixed;
        bottom: 0;
        width: 100%;
        box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
    }
    footer p {
        margin: 0;
        padding: 0;
    }
</style>