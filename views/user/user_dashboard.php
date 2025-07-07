<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: signin.php");
    exit();
}
if (isset($_SESSION['isadmin']) && $_SESSION['isadmin'] === true) {
    header("Location: admin_dashboard.php");
    exit();
}


require_once('../../controller/BookController.php');
$controller = new BookController();
$books = $controller->fetchBooks();

$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
    <div class="container mt-5">
        <h1 class="text-center">Welcome, <?= $user['first_name'] ?>!</h1>

        <div class="card mt-4 shadow">
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
