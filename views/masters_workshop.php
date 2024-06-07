<?php $lang = isset($_COOKIE['lang']) ? $_COOKIE['lang'] : 'UA';
$translations = include "$lang.php";
?>

<?php
class item{
    private $name;
    private $price;
    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }
    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

}
function getItemsByPrice($pdo, $price) {
    $stmt = $pdo->prepare("SELECT * FROM items WHERE price = :price");
    $stmt->execute(['price' => $price]);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $items;
}
function getAllItems($pdo) {
    $stmt = $pdo->query("SELECT * FROM items");
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $items;
}

class magicitem extends Item{
    private $rarity;
    private $description;
    public function __construct($name, $price, $rarity, $description) {
        parent::__construct($name, $price);
        $this->rarity = $rarity;
        $this->description = $description;
    }
    public function getRarity() {
        return $this->rarity;
    }

    public function getDescription() {
        return $this->description;
    }
}

?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Майстерня</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>


<button class="filter-button" onclick="toggleFilterMenu('filterMenu')">Фільтри</button>

    <div class="filter-menu" id="filterMenu">
        <form action="/workshop" method="get">
            <label for="itemNameFilter">Назва предмету:</label>
            <input type="text" id="itemNameFilter" name="itemNameFilter">

            <label for="itemPriceFilter">Ціна предмету:</label>
            <input type="number" id="itemPriceFilter" name="itemPriceFilter">

            <label for="itemRarityFilter">Рідкість:</label>
            <select id="itemRarityFilter" name="itemRarityFilter">
                <option value="">Всі</option>
                <option value="Звичайний">Звичайний</option>
                <option value="Незвичайний">Незвичайний</option>
                <option value="Рідкісний">Рідкісний</option>
                <option value="Дуже рідкісний">Дуже рідкісний</option>
                <option value="Легендарний">Легендарний</option>
                <option value="Інший">Інший</option>
            </select>

            <input type="submit" value="Застосувати">
        </form>
    </div>

<button class="dangerLavel-button" onclick="toggleFilterMenu('dangerLavelMenu')">Розрахунок винагороди</button>

    <div class="dangerLavel-menu" id="dangerLavelMenu">
        <form action="/workshop" method="get">
            <label for="dangerLavelFilter">Рівень небезпеки:</label>
            <select id="dangerLavelFilter" name="dangerLavel">
                <option value="1">0-4</option>
                <option value="5">5-10</option>
            </select>

            <input type="submit" value="Застосувати">
        </form>
    </div>

    <!-- Таблиця з предметами -->
    <table>
        <thead>
            <tr>
                <th>Назва</th>
                <th>Ціна</th>
                <th>Рідкість</th>
                <th>Кількість</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($item['name']); ?></td>
                <td><?php echo htmlspecialchars($item['price']); ?></td>
                <td><?php echo htmlspecialchars($item['rarity'] !== null ? $item['rarity'] : ''); ?></td>
                <td><?php echo htmlspecialchars($item['number'] !== null ? $item['number'] : ''); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        function toggleFilterMenu(formId) {
            var filterMenu = document.getElementById(formId);
            if (filterMenu.style.display === "none" || filterMenu.style.display === "") {
                filterMenu.style.display = "block";
            } else {
                filterMenu.style.display = "none";
            }
        }

    </script>

<?php


$is_admin = false;
include_once 'config/db.php';


//$items = getItemsByPrice($pdo, 10);

//$items = array_merge($items, getAllItems($pdo));
/*
foreach ($items as $item) {
    echo "Назва: " . $item['name'] . ", Ціна: " . $item['price'] . "<br>";
}
*/

// Функція для отримання ролі користувача
function getUserRole($pdo, $username) {
    $stmt = $pdo->prepare("SELECT role FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();
    return $user ? $user['role'] : null;
}

// Перевірка, чи користувач авторизований
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $role = getUserRole($pdo, $username);
    if ($role === 'admin') {
        // Код для адміністратора
        $is_admin = true;
    }
    else{
        $is_admin = false;
    }
} 

if ($is_admin) {
    // Якщо користувач - адміністратор, виводимо кнопку
    echo '<button onclick="toggleForm(\'addItemForm\')">Додати предмет</button>';
    echo '<button onclick="toggleForm(\'addMagicItemForm\')">Додати магічний предмет або зілля</button>';
}

?>

<!-- Вікно форми, яке відображається при натисканні кнопки -->
<div id="addItemForm" style="display:none;">
    <form action='/save_item' method="post">
        <label for="itemName">Назва предмету:</label>
        <input type="text" id="itemName" name="itemName" required><br><br>
        
        <label for="itemPrice">Ціна предмету:</label>
        <input type="number" id="itemPrice" name="itemPrice" required><br><br>

        <button type="button" onclick="closeForm('addItemForm')">Закрити</button>
        <input type="submit" value="Зберегти"> 
    </form>
</div>

<!-- Вікно форми для додавання магічного предмету або зілля -->
<div id="addMagicItemForm" style="display:none;">
    <form action='/save_magic_item' method="post">
        <label for="magicItemName">Назва магічного предмету або зілля:</label>
        <input type="text" id="magicItemName" name="magicItemName" required><br><br>
        
        <label for="magicItemPrice">Ціна:</label>
        <input type="number" id="magicItemPrice" name="magicItemPrice" required><br><br>
        
        <label for="magicItemRarity">Рідкість:</label>
        <select id="magicItemRarity" name="magicItemRarity" required>
            <option value="Звичайний">Звичайний</option>
            <option value="Незвичайний">Незвичайний</option>
            <option value="Рідкісний">Рідкісний</option>
            <option value="Дуже рідкісний">Дуже рідкісний</option>
            <option value="Легендарний">Легендарний</option>
            <option value="Інший">Інший</option>
        </select><br><br>
        
        <label for="magicItemDescription">Опис:</label>
        <textarea id="magicItemDescription" name="magicItemDescription" required></textarea><br><br>
        
        <button type="button" onclick="closeForm('addMagicItemForm')">Закрити</button>
        <input type="submit" value="Зберегти">
    </form>
</div>

<script>
// JavaScript-функція, яка відображає або приховує форму при натисканні кнопки
function toggleForm(formId) {
    var form = document.getElementById(formId);
    if (form.style.display === "none") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
}

function closeForm(formId) {
    var form = document.getElementById(formId);
    form.style.display = "none";
}

</script>


