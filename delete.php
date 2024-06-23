<?php
include 'db.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "DELETE FROM student WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Student</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Delete Student</h1>
        <p>Are you sure you want to delete this student?</p>
        <form method="post">
            <button type="submit" class="btn btn-danger">Delete</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
