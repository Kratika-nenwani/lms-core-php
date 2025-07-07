<?php
require_once(__DIR__ . '/../config/db.php');

class User {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function isUserExists($email, $unique_name) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ? OR unique_name = ?");
        $stmt->execute([$email, $unique_name]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
    }

    public function registerUser($data) {
        $stmt = $this->conn->prepare("
            INSERT INTO users (first_name, last_name, unique_name, email, password, mobile) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['unique_name'],
            $data['email'],
            $data['password'],
            $data['phone']
        ]);
    }

    public function loginUser($unique_name, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE unique_name = ?");
        $stmt->execute([$unique_name]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }
}
?>
