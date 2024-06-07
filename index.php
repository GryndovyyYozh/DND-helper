<?php
if (session_status() == PHP_SESSION_ACTIVE) {
    // Сесія вже активна
} else {
    // Сесія ще не активна
    session_start();
}

require_once 'config/db.php';
//include 'config/db.php';

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Оновлення лічильника відвідувань
    $stmt = $pdo->prepare("UPDATE users SET visit_count = visit_count + 1 WHERE id = ?");
    $stmt->execute([$userId]);

    // Отримання оновленого значення лічильника
    $stmt = $pdo->prepare("SELECT visit_count FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();

} else {
    //echo "Користувач не авторизований.";
}

$sql = "UPDATE visit_counter SET visit_count = visit_count + 1 WHERE id = 1";
$conn->query($sql);

$sql = "SELECT visit_count FROM visit_counter WHERE id = 1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$visit_count = $row['visit_count'];

$request = $_SERVER['REQUEST_URI'];
$url_parts = parse_url($request);
$path = $url_parts['path'];
$query = $url_parts['query'] ?? '';

switch ($path) {
    
    case '/' :
        include 'controllers/home.php';
        break;
    case '' :
        include 'controllers/home.php';
        break;
    case '/account' :
        include 'controllers/account.php';
        break;
    case '/workshop' :
        include 'controllers/masters_workshop.php';
        break;
    case '/workshop_hub' :
        include 'controllers/workshop_hub.php';
        break;
    case '/guide' :
        include 'controllers/directory.php';
        break;
    case '/save_item' :
        include 'save/save_item.php';
        break;
    case '/save_magic_item' :
        include 'save/save_magic_item.php';
        break;
    case '/register' :
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'user')");
            $stmt->execute([$username, $email, $password]);

            header('Location: /login');
            exit;
        } else {
            include 'views/register.php';
        }
        break;
    case '/login' :
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header('Location: /account');
                exit;
            } else {
                $error = 'Неправильне ім\'я користувача або пароль';
                include 'controllers/login.php';
            }
        } else {
            include 'controllers/login.php';
        }
        break;
    case '/logout' :
        session_start();
        session_unset();
        session_destroy();
        header('Location: /login');
        break;
    case '/edit-profile' :
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $userId = $_SESSION['user_id'];

            $stmt = $pdo->prepare('UPDATE users SET username = ?, email = ? WHERE id = ?');
            $stmt->execute([$username, $email, $userId]);

            $_SESSION['username'] = $username;

            header('Location: /account');
            exit;
        } else {
            $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
            $stmt->execute([$_SESSION['user_id']]);
            $user = $stmt->fetch();

            include 'controllers/edit-profile.php';
        }
        break;
    default:
        http_response_code(404);
        echo "{$path}";
        include 'controllers/404.php';
        break;
}
?>