<?php
include_once 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Отримання даних з форми
    $magicItemName = $_POST['magicItemName'];
    $magicItemPrice = $_POST['magicItemPrice'];
    $magicItemRarity = $_POST['magicItemRarity'];
    $magicItemDescription = $_POST['magicItemDescription'];
    
    try {
        // Виконання запиту до бази даних для збереження предмету
        $stmt = $pdo->prepare("INSERT INTO magic_items (name, price, rarity, description) VALUES (:name, :price, :rarity, :description)");
        $stmt->execute([
        'name' => $magicItemName,
        'price' => $magicItemPrice,
        'rarity' => $magicItemRarity,
        'description' => $magicItemDescription
        ]);
        // Перенаправлення користувача на потрібну сторінку після збереження
        header("Location: /workshop");
        echo "Магічний предмет успішно додано!";
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