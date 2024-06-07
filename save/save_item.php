<?php
include_once 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Отримання даних з форми
    $itemName = $_POST['itemName'];
    $itemPrice = $_POST['itemPrice'];
    
    try {
        // Виконання запиту до бази даних для збереження предмету
        $stmt = $pdo->prepare("INSERT INTO items (name, price) VALUES (?, ?)");
        $stmt->execute([$itemName, $itemPrice]);
        
        // Перенаправлення користувача на потрібну сторінку після збереження
        header("Location: /workshop");
        echo "Предмет успішно додано!";
        exit();
    } catch (PDOException $e) {
        // Обробка помилок, якщо вони виникнуть
        echo "Помилка: " . $e->getMessage();
    }
} else {
    // Якщо форма не була відправлена методом POST, перенаправте користувача на головну сторінку або виведіть повідомлення про помилку
    header("Location: index.php");
    exit();
}
?>