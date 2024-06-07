<?php $lang = isset($_COOKIE['lang']) ? $_COOKIE['lang'] : 'UA';
$translations = include "$lang.php";
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Довідник</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>

<div class="container">
        <div class="card" onclick="showDescription(this)">
            <!--<img src="category1.jpg" alt="Category 1">-->
            <div class="card-content">
                <h3>Рух</h3>
                <p>Вартість руху: 5 футів за переміщення на 5 футів
                    Якщо у вас є кілька швидкостей, наприклад швидкість ходьби і швидкість польоту, ви можете перемикатися між ними під час переміщення. При кожному перемиканні віднімайте пройдену відстань з нової швидкості.
                    Ви можете проходити крізь простір неворожих істот.
                    Простір інших істот є для вас важкою місцевістю.
                    Крізь простір ворожої істоти можна пройти тільки якщо його розмір як мінімум на дві категорії більший або менший за вашу.
                    Незалежно від того, дружня істота чи ні, ви не можете добровільно закінчити переміщення у його просторі.</p>
            </div>
        </div>
        <div class="card" onclick="showDescription(this)">
            <!--<img src="category2.jpg" alt="Category 2">-->
            <div class="card-content">
                <h3>Дія</h3>
                <p>Якщо ви в свій хід чините дію, це може бути одна з наведених нижче дій, дія, дарована класом або особливим умінням, або імпровізована дія.
                    Приклади:<br>
                    -Атака
                    <br>-Взяти щит
                    <br>-Ривок
                    <br>-Захват
                    <br>-Допомога 
                </p>
            </div>
        </div>
        <div class="card" onclick="showDescription(this)">
            <!--<img src="category3.jpg" alt="Category 3">-->
            <div class="card-content">
                <h3>Реакція</h3>
                <p>Реакція - це миттєва відповідь на спрацювання певної умови (тригера), яка може відбуватися як у ваш, так і в чужий хід.
                    <br>-Накладення магії
                    <br>-Заготована атака
                    <br>-Провакована атака
                </p>
            </div>
        </div>
    </div>

    <script>
        function showDescription(card) {
            // Закриваємо всі відкриті картки перед відкриттям нової
            const expandedCards = document.querySelectorAll('.card.expanded');
            expandedCards.forEach(expandedCard => expandedCard.classList.remove('expanded'));

            // Відкриваємо обрану картку
            card.classList.add('expanded');
        }

        function hideDescription(event, button) {
            event.stopPropagation(); // Зупиняємо спливання події, щоб не спрацьовував onclick картки
            button.closest('.card').classList.remove('expanded');
        }
    </script>