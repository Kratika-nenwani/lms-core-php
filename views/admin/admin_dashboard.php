<?php
session_start();

if (!isset($_SESSION['user']) || !isset($_SESSION['isadmin'])) {
    header("Location: signin.php");
    exit();
}

require_once('../../controller/BookController.php');
$controller = new BookController();
$user = $_SESSION['user'];

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_book'])) {
    if ($controller->AddBook()) {
        $message = "<div class='alert alert-success'>Book added successfully!</div>";
    } else {
        $message = "<div class='alert alert-danger'>Failed to add book.</div>";
    }
}

$books = $controller->fetchBooks();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class=" text-dark">
    <div class="container mt-5">
        <h1 class="text-center">Welcome Admin </h1>

        <?= $message ?>

        <div class="card mt-4 bg-dark text-white">
            <div class="card-body">
                <h4>Admin Controls</h4>
                
                <h4 class="mt-4">Add New Book</h4>
                <form method="POST" action="">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Author</label>
                            <input type="text" name="author" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>ISBN</label>
                            <input type="text" name="isbn" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Quantity</label>
                            <input type="number" name="quantity" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Publisher</label>
                            <input type="text" name="publisher" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Published Year</label>
                            <input type="text" name="published_year" class="form-control" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <button type="submit" name="add_book" class="btn btn-success">Add Book</button>
                </form>
            </div>
        </div>
       
    
        <div class="bg-dark text-white card mt-4 shadow">
            <div class="card-body">
                <h4 class="mb-3">Available Books</h4>
                <?php if (!empty($books)): ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>ISBN</th>
                                <th>Quantity</th>
                                <th>Publisher</th>
                                <th>Published Year</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($books as $book): ?>
                                <tr>
                                    <td><?=$book['title'] ?></td>
                                    <td><?=$book['author']?></td>
                                    <td><?= $book['isbn']?></td>
                                    <td><?= $book['quantity'] ?></td>
                                    <td><?= $book['publisher'] ?></td>
                                    <td><?= $book['published_year'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No books Available</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="../logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
</body>
</html>
