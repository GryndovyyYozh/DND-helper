<?php
// Оновлення лічильника відвідувань
if (session_status() == PHP_SESSION_ACTIVE) {
    // Сесія вже активна
} else {
    // Сесія ще не активна
    session_start(); // Розпочати сесію
}

// Запис логів користувачів
$ip_address = $_SERVER['REMOTE_ADDR'];
$page_url = $_SERVER['REQUEST_URI'];
$time_visited = date("Y-m-d H:i:s");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dnd_master";

$conn = new mysqli($servername, $username, $password, $dbname);

// Перевірка з'єднання
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL-запит для вставки логів користувачів
$sql = "INSERT INTO user_logs (ip_address, page_url, time_visited) VALUES ('$ip_address', '$page_url', '$time_visited')";

// Виконання запиту
if ($conn->query($sql) === TRUE) {
    // echo "Log record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$lang = isset($_COOKIE['lang']) ? $_COOKIE['lang'] : 'UA';

$translations = include "$lang.php";
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Головна сторінка</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
    
        <h1>
            <?php echo $translations['Це головна сторінка']?>
        </h1>
        <p><?php echo $translations['Ласкаво просимо!']?></p>

    <!--<?php echo "Total page views: " . $_SESSION['page_views'];?>-->
