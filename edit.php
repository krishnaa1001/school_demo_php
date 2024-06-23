<?php
include 'db.php';

$id = $_GET['id'];

// Fetch student details
$sql = "SELECT * FROM student WHERE id = $id";
$result = $conn->query($sql);
$student = $result->fetch_assoc();

// Handle form submission to update student
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $class_id = $_POST['class_id'];

    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        $target = "uploads/" . basename($image);

        // Validate image format
        $allowed_types = ['image/jpeg', 'image/png'];
        if (in_array($_FILES['image']['type'], $allowed_types)) {
            // Generate unique filename
            $unique_filename = uniqid() . "_" . basename($image);
            $target = "uploads/" . $unique_filename;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $sql = "UPDATE student SET name='$name', email='$email', address='$address', class_id='$class_id', image='$unique_filename' WHERE id = $id";
            } else {
                echo "Failed to upload image";
            }
        } else {
            echo "Invalid image format. Only JPG and PNG are allowed.";
        }
    } else {
        $sql = "UPDATE student SET name='$name', email='$email', address='$address', class_id='$class_id' WHERE id = $id";
    }

    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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
    <title>Edit Student</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Edit Student</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" class="form-control" value="<?php echo $student['name']; ?>" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" value="<?php echo $student['email']; ?>" required>
            </div>
            <div class="form-group">
                <label>Address:</label>
                <textarea name="address" class="form-control"><?php echo $student['address']; ?></textarea>
            </div>
            <div class="form-group">
                <label>Class:</label>
                <select name="class_id" class="form-control" required>
                    <?php while ($row = $classes->fetch_assoc()): ?>
                        <option value="<?php echo $row['class_id']; ?>" <?php if ($student['class_id'] == $row['class_id']) echo 'selected'; ?>><?php echo $row['name']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Image:</label>
                <input type="file" name="image" class="form-control-file" accept="image/*">
                <?php if ($student['image']): ?>
                    <img src="uploads/<?php echo $student['image']; ?>" width="100" class="img-thumbnail mt-2">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>



