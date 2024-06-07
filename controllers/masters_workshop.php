<?php

include 'controllers/header.php';

$host = 'localhost';
$db = 'dnd_master';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$itemNameFilter = isset($_GET['itemNameFilter']) ? ($_GET['itemNameFilter']) : null;
$itemPriceFilter = isset($_GET['itemPriceFilter']) ? ($_GET['itemPriceFilter']) : null;
$itemRarityFilter = isset($_GET['itemRarityFilter']) ? ($_GET['itemRarityFilter']) : null;

$itemDangerFilter = isset($_GET['dangerLavel']) ? ($_GET['dangerLavel']) : null;

if($itemDangerFilter == 1){
    $itemDangerFilter = 100;
}
else if($itemDangerFilter == 5) {
    $itemDangerFilter = 1000;
}
else{
    $sql = "SELECT name, price, NULL AS rarity, NULL AS number FROM items WHERE 1=1";

if (!empty($itemNameFilter)) {
    // Додаємо умову для фільтрації за назвою предмету
    $sql .= " AND name LIKE '%$itemNameFilter%'";
}

if (!empty($itemPriceFilter)) {
    // Додаємо умову для фільтрації за ціною
    $sql .= " AND price = $itemPriceFilter";
}

$stmt = $pdo->query($sql);
$items = $stmt->fetchAll();

// Побудова SQL-запиту з урахуванням параметрів фільтрації
$sql = "SELECT name, price, rarity, NULL AS number FROM magic_items WHERE 1=1";

if (!empty($itemNameFilter)) {
    // Додаємо умову для фільтрації за назвою предмету
    $sql .= " AND name LIKE '%$itemNameFilter%'";
}

if (!empty($itemPriceFilter)) {
    // Додаємо умову для фільтрації за ціною
    $sql .= " AND price = $itemPriceFilter";
}

if (!empty($itemRarityFilter)) {
    // Додаємо умову для фільтрації за рідкістю предмету
    $sql .= " AND rarity = '$itemRarityFilter'";
}

$stmt = $pdo->query($sql);
if(!empty($itemRarityFilter)){
    $items = $stmt->fetchAll();
}
else{
    $items = array_merge($items, $stmt->fetchAll());
}

}

function randomizer() {
    $randomNumber = mt_rand() / mt_getrandmax(); // Генерує випадкове число від 0 до 1
    return $randomNumber >= 0.5;
}

if($itemDangerFilter >= 100){
if(randomizer()){
    $sql = " 
    SELECT name, price, NULL AS rarity, NULL AS number FROM items
    WHERE price <= :itemDangerFilter
    ORDER BY RAND()
    LIMIT 1;
    ";



$stmt = $pdo->prepare($sql);
$stmt->execute(['itemDangerFilter' => $itemDangerFilter]);
$items = $stmt->fetchAll();
}
else{
    $sql = " 
    SELECT name, price, rarity, NULL AS number FROM magic_items
    WHERE price <= :itemDangerFilter
    ORDER BY RAND()
    LIMIT 1;
    ";


$stmt = $pdo->prepare($sql);
$stmt->execute(['itemDangerFilter' => $itemDangerFilter]);
$items = $stmt ->fetchAll();
//$items = array_merge($items1, $items2);

//print_r($items);
}



//$items = $items2;

foreach ($items as &$item) {
    $item['number'] =  $itemDangerFilter/$item['price'];
}

}

require 'views/masters_workshop.php';

include 'controllers/footer.php';
?>