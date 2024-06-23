<?php
include 'db.php';

// Handle form submission to add a new class
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
    $name = $_POST['name'];
    $sql = "INSERT INTO classes (name) VALUES ('$name')";
    if ($conn->query($sql) === TRUE) {
        header('Location: classes.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle deleting a class
if (isset($_GET['delete'])) {
    $class_id = $_GET['delete'];
    $sql = "DELETE FROM classes WHERE class_id = $class_id";
    if ($conn->query($sql) === TRUE) {
        header('Location: classes.php');
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Fetch all classes
$sql = "SELECT * FROM classes";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Classes</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Manage Classes</h1>
        <form method="post">
            <div class="form-group">
                <label>Class Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Class</button>
        </form>
        <h2 class="mt-5">Class List</h2>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Class Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td>
                        <a href="edit_class.php?id=<?php echo $row['class_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="classes.php?delete=<?php echo $row['class_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this class?');">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
