<?php
include 'config/db.php';


if (empty($_GET['id'])) {
    die("<p style='color:red; text-align:center;'>⚠️ Error: Missing student ID.<br><a href='read.php'>Back</a></p>");
}

$id = $_GET['id'];


try {
    $stmt = $pdo->prepare("SELECT fullname FROM students WHERE id = ?");
    $stmt->execute([$id]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$student) {
        die("<p style='color:red; text-align:center;'>❌ Student not found.<br><a href='read.php'>Back</a></p>");
    }
} catch (PDOException $e) {
    die("Error fetching record: " . $e->getMessage());
}


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['confirm'])) {
    try {
        $del = $pdo->prepare("DELETE FROM students WHERE id = ?");
        $del->execute([$id]);
        echo "<script>alert('✅ Student record deleted successfully!'); window.location='read.php';</script>";
        exit;
    } catch (PDOException $e) {
        die("Error deleting record: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Delete Student</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #0b0b0b;
        color: #eee;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        background-color: #1a1a1a;
        padding: 35px;
        border-radius: 12px;
        text-align: center;
        width: 380px;
        box-shadow: 0 0 18px rgba(160, 32, 240, 0.3);
        border: 1px solid rgba(160, 32, 240, 0.2);
    }

    h2 {
        color: #ff4c4c;
        margin-bottom: 15px;
    }

    p {
        font-size: 15px;
        color: #ccc;
        line-height: 1.5;
    }

    .student-name {
        color: #a020f0;
        font-weight: bold;
        margin: 10px 0;
    }

    .warning {
        background-color: #2b0000;
        color: #ffaaaa;
        padding: 10px;
        border-radius: 6px;
        margin-top: 15px;
        font-size: 14px;
    }

    form {
        margin-top: 25px;
    }

    button, .cancel-btn {
        padding: 10px 18px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
        margin: 6px;
        transition: 0.25s;
        text-decoration: none;
        display: inline-block;
    }

    .confirm {
        background-color: #ff3333;
        color: white;
    }

    .confirm:hover {
        background-color: #cc0000;
        box-shadow: 0 0 10px rgba(255, 0, 0, 0.6);
    }

    .cancel-btn {
        background-color: #5a2a8a;
        color: white;
    }

    .cancel-btn:hover {
        background-color: #7d3fc2;
        box-shadow: 0 0 10px rgba(160, 32, 240, 0.5);
    }

    a.back {
        display: block;
        text-align: center;
        color: #a020f0;
        margin-top: 20px;
        text-decoration: none;
    }

    a.back:hover {
        color: #ff3333;
        text-decoration: underline;
    }
</style>
</head>
<body>

<div class="container">
    <h2>⚠️ Delete Confirmation</h2>
    <p>Are you sure you want to delete this record?</p>
    <p class="student-name"><?= htmlspecialchars($student['fullname']); ?></p>
    <p class="warning">Once deleted, this record <strong>cannot be restored.</strong></p>

    <form method="POST">
        <button type="submit" name="confirm" class="confirm">Yes, Delete</button>
        <a href="read.php" class="cancel-btn">Cancel</a>
    </form>

    <a href="read.php" class="back">← Back to Student List</a>
</div>

</body>
</html>
