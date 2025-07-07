<?php
require_once('../../model/Book.php');
// require_once('../model/Book.php');

class BookController {
    private $bookModel;

    public function __construct() {
        $this->bookModel = new Book();
    }

    public function fetchBooks() {
        return $this->bookModel->getAllBooks();
    }

    public function AddBook() {
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_book'])) {
        $bookData = [
            'title' => $_POST['title'],
            'author' => $_POST['author'],
            'isbn' => $_POST['isbn'],
            'quantity' => $_POST['quantity'],
            'description' => $_POST['description'],
            'publisher' => $_POST['publisher'],
            'published_year' => $_POST['published_year'],
        ];

        return $this->bookModel->addBook($bookData);
    }
    return false;
}
}


?>
