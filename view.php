<?php
include 'db.php';


if (isset($_GET['id'])) {
    $student_id = $_GET['id'];

   
    $sql = "SELECT * FROM student WHERE id = $student_id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $student = $result->fetch_assoc(); 
    } else {
        echo "Student not found.";
    }
} else {
    echo "Student ID not provided.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Student</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">View Student</h1>
        <?php if (isset($student)): ?>
        <div>
            <p>Name: <?php echo $student['name']; ?></p>
            <p>Email: <?php echo $student['email']; ?></p>
            <p>Address: <?php echo $student['address']; ?></p>
            <?php
            
            $class_id = $student['class_id'];
            $class_sql = "SELECT name FROM classes WHERE class_id = $class_id";
            $class_result = $conn->query($class_sql);
            if ($class_result && $class_result->num_rows > 0) {
                $class_row = $class_result->fetch_assoc();
                echo "<p>Class: " . $class_row['name'] . "</p>";
            }
            ?>
            <p>Image: <img src="uploads/<?php echo $student['image']; ?>" alt="Student Image" style="max-width: 200px;"></p>
            <p>Created At: <?php echo $student['created_at']; ?></p>
        </div>
        <?php else: ?>
        <p>Student data not available.</p>
        <?php endif; ?>
    </div>
</body>
</html>
