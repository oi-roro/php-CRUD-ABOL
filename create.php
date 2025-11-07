<?php
include 'config/db.php';

$message = "";
$errors = [];

$student_no = "";
$fullname = "";
$branch = "";
$email = "";
$contact = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_no = trim($_POST['student_no']);
    $fullname   = trim($_POST['fullname']);
    $branch     = trim($_POST['branch']);
    $email      = trim($_POST['email']);
    $contact    = trim($_POST['contact']);

    if ($student_no == "") $errors[] = "Student Number is required.";
    if ($fullname == "") $errors[] = "Full Name is required.";
    if ($branch == "") $errors[] = "Branch is required.";
    if ($email == "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid Email is required.";
    if ($contact == "") $errors[] = "Contact is required.";

    if (empty($errors)) {
        try {
            $sql = "INSERT INTO students (student_no, fullname, branch, email, contact, date_added)
                    VALUES (?, ?, ?, ?, ?, NOW())";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$student_no, $fullname, $branch, $email, $contact]);

            $message = "<p class='success'>✅ Student added successfully!</p>";

            $student_no = $fullname = $branch = $email = $contact = "";

        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $errors[] = "That Student Number or Email already exists.";
            } else {
                $errors[] = "Database error: " . $e->getMessage();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Student</title>
<style>
    body {
        background: #0b0b0d; 
        color: #f2f2f2;
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .card {
        background: #151515;
        padding: 50px;
        border-radius: 12px;
        width: 360px;
        box-shadow: 0 0 20px rgba(128, 0, 128, 0.4); 
        border: 1px solid #660066;
    }

    h2 {
        text-align: center;
        color: #b026ff; 
        margin-bottom: 15px;
        letter-spacing: 1px;
    }

    label {
        display: block;
        margin-top: 10px;
        font-weight: bold;
        font-size: 14px;
        color: #ff4d4d; 
    }

    input, select {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #3a003a;
        border-radius: 6px;
        background: #1e1e1e;
        color: white;
        transition: 0.3s;
    }

    input:focus, select:focus {
        outline: none;
        border-color: #b026ff;
        box-shadow: 0 0 8px rgba(176, 38, 255, 0.6);
    }

    input[type="submit"] {
        background: linear-gradient(90deg, #b026ff, #ff0040);
        color: #fff;
        font-weight: bold;
        margin-top: 15px;
        border: none;
        cursor: pointer;
        transition: 0.3s;
    }

    input[type="submit"]:hover {
        transform: scale(1.03);
        box-shadow: 0 0 12px rgba(255, 0, 64, 0.7);
    }

    .errors {
        background: rgba(64, 0, 0, 0.6);
        border: 1px solid #ff3333;
        color: #ffcccc;
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 10px;
    }

    .success {
        background: rgba(0, 40, 0, 0.6);
        border: 1px solid #660066;
        color: #b3ffb3;
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 10px;
        text-align: center;
    }

    a {
        display: block;
        text-align: center;
        margin-top: 10px;
        color: #ff0040;
        text-decoration: none;
        transition: 0.3s;
    }

    a:hover {
        color: #b026ff;
    }
</style>
</head>
<body>
    <div class="card">
        <h2>Add Student Record</h2>

        <?php
        if (!empty($errors)) {
            echo "<div class='errors'><ul>";
            foreach ($errors as $err) echo "<li>$err</li>";
            echo "</ul></div>";
        }
        echo $message;
        ?>

        <form method="post">
            <label>Student Number</label>
            <input type="text" name="student_no" value="<?= htmlspecialchars($student_no) ?>" required>

            <label>Full Name</label>
            <input type="text" name="fullname" value="<?= htmlspecialchars($fullname) ?>" required>

            <label>Branch</label>
            <select name="branch" required>
                <option value="">Select Branch</option>
                <?php
                $branches = ['BSIT','BSND','BSTM','BSBA', 'BSP','BSHRM'];
                foreach ($branches as $b) {
                    $selected = ($branch == $b) ? 'selected' : '';
                    echo "<option value='$b' $selected>$b</option>";
                }
                ?>
            </select>

            <label>Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required>

            <label>Contact</label>
            <input type="text" name="contact" value="<?= htmlspecialchars($contact) ?>" required>

            <input type="submit" value="Save Student">
        </form>

        <a href="index.php">← Back to Homepage</a>
    </div>
</body>
</html>
