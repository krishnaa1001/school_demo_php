<?php
include 'db.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $class_id = $_POST['class_id'];
    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image);

    // Validate image format
    $allowed_types = ['image/jpeg', 'image/png'];
    if (in_array($_FILES['image']['type'], $allowed_types)) {
        // Generate unique filename
        $unique_filename = uniqid() . "_" . basename($image);
        $target = "uploads/" . $unique_filename;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $sql = "INSERT INTO student (name, email, address, class_id, image) VALUES ('$name', '$email', '$address', '$class_id', '$unique_filename')";
            if ($conn->query($sql) === TRUE) {
                header('Location: index.php');
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Failed to upload image";
        }
    } else {
        echo "Invalid image format. Only JPG and PNG are allowed.";
    }
}

// Fetch all classes
$sql = "SELECT * FROM classes";
$classes = $conn->query($sql);

if (!$classes) {
    die("Query failed: " . $conn->error);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Student</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Create Student</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Address:</label>
                <textarea name="address" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>Class:</label>
                <select name="class_id" class="form-control" required>
                    <?php while ($row = $classes->fetch_assoc()): ?>
                        <option value="<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Image:</label>
                <input type="file" name="image" class="form-control-file" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</body>
</html>
