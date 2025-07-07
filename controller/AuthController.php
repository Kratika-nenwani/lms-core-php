<?php
session_start();
require_once(__DIR__ . '/../model/User.php'); // Use absolute path
header('Content-Type: application/json');

$user = new User();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST['action'] ?? '';
    $unique_name = $_POST['unique_name'] ?? '';

    if ($action === 'signup') {
        $email = $_POST['email'] ?? '';
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if ($user->isUserExists($email, $unique_name)) {
            echo json_encode(["status" => "error", "message" => "Email or Unique Name already exists"]);
        } elseif ($user->registerUser($_POST)) {
            echo json_encode(["status" => "success", "message" => "Registered successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Registration failed"]);
        }
        exit;
    }

    if ($action === 'login') {
        $password = $_POST['password'] ?? '';
        $login = $user->loginUser($unique_name, $password);

        if ($login) {
            $_SESSION['user'] = $login;
            if (!empty($login['isadmin'])) {
                $_SESSION['isadmin'] = true;
            }

            echo json_encode([
                "status" => "success",
                "message" => "Login successful",
                "isadmin" => !empty($login['isadmin']) ? true : false
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Invalid credentials"
            ]);
        }
        exit;
    }
}
?>
