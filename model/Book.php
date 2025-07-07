<?php
require_once(__DIR__ . '/../config/db.php');

class Book {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAllBooks() {
        $stmt = $this->conn->prepare("SELECT * FROM books");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addBook($data) {
        $stmt = $this->conn->prepare("
            INSERT INTO books 
            (title, author, isbn, quantity, description, publisher, published_year) 
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");

        return $stmt->execute([
            $data['title'],
            $data['author'],
            $data['isbn'],
            $data['quantity'],
            $data['description'],
            $data['publisher'],
            $data['published_year']
        ]);
    }
}
?>
