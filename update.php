<?php
include 'config/db.php';


if (empty($_GET['id'])) {
    die("<p style='color:red; text-align:center;'>⚠️ Invalid student ID.<br><a href='read.php'>Back</a></p>");
}

$id = $_GET['id'];
$message = "";


try {
    $stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
    $stmt->execute([$id]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$student) {
        die("<p style='color:red; text-align:center;'>❌ Student not found.<br><a href='read.php'>Back</a></p>");
    }
} catch (PDOException $e) {
    die("Error fetching record: " . $e->getMessage());
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_no = $_POST['student_no'];
    $fullname = $_POST['fullname'];
    $branch = $_POST['branch'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];

    try {
        $sql = "UPDATE students 
                SET student_no=?, fullname=?, branch=?, email=?, contact=? 
                WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$student_no, $fullname, $branch, $email, $contact, $id]);

        echo "<script>alert('✅ Student updated successfully!'); window.location='read.php';</script>";
        exit;
    } catch (PDOException $e) {
        $message = "<p style='color:#ff5555;'>❌ Update failed: " . $e->getMessage() . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Update Student</title>
<style>
    body {
        font-family: 'Segoe UI', Arial, sans-serif;
        background-color: #0a0a0a;
        color: #eaeaea;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
    }

    .form-box {
        background-color: #1a1a1a;
        padding: 30px 35px;
        border-radius: 12px;
        width: 380px;
        box-shadow: 0 0 15px rgba(160, 32, 240, 0.3);
    }

    h2 {
        text-align: center;
        color: #a020f0;
        margin-bottom: 20px;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    label {
        font-weight: bold;
        font-size: 14px;
        color: #ccc;
    }

    input, select {
        padding: 10px;
        border: none;
        border-radius: 6px;
        background-color: #2a2a2a;
        color: #fff;
        font-size: 14px;
    }

    input:focus, select:focus {
        outline: 2px solid #a020f0;
    }

    .btn {
        background-color: #a020f0;
        color: white;
        font-weight: bold;
        border: none;
        cursor: pointer;
        margin-top: 10px;
        padding: 10px;
        border-radius: 6px;
        transition: 0.3s;
    }

    .btn:hover {
        background-color: #9015d0;
    }

    .back {
        display: block;
        text-align: center;
        margin-top: 15px;
        text-decoration: none;
        color: #a020f0;
    }

    .back:hover {
        text-decoration: underline;
        color: #ff5555;
    }

    .msg {
        text-align: center;
        margin-bottom: 10px;
    }
</style>
</head>
<body>

<div class="form-box">
    <h2>Edit Student Record</h2>
    <div class="msg"><?= $message ?></div>

    <form method="POST">
        <label>Student No</label>
        <input type="text" name="student_no" value="<?= htmlspecialchars($student['student_no']); ?>" required>

        <label>Full Name</label>
        <input type="text" name="fullname" value="<?= htmlspecialchars($student['fullname']); ?>" required>

        <label>Branch</label>
        <select name="branch" required>
            <?php
            $branches = ['BSIT', 'BSCS', 'BSCE', 'BSECE'];
            foreach ($branches as $b) {
                $selected = ($student['branch'] === $b) ? 'selected' : '';
                echo "<option value='$b' $selected>$b</option>";
            }
            ?>
        </select>

        <label>Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($student['email']); ?>" required>

        <label>Contact</label>
        <input type="text" name="contact" value="<?= htmlspecialchars($student['contact']); ?>" required>

        <button type="submit" class="btn">Save Changes</button>
    </form>

    <a href="read.php" class="back">← Back to Student List</a>
</div>

</body>
</html>
