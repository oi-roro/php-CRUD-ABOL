<?php
include 'config/db.php';

// Fetch all student records
try {
    $query = "SELECT * FROM students ORDER BY id DESC";
    $result = $pdo->query($query);
    $students = $result->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error loading records: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student List</title>

<style>
    body {
        font-family: 'Segoe UI', Arial, sans-serif;
        background-color: #0a0a0a;
        color: #f2f2f2;
        margin: 0;
        padding: 40px 0;
    }

    .container {
        width: 90%;
        max-width: 900px;
        background-color: #1a1a1a;
        margin: auto;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 0 20px rgba(160, 32, 240, 0.3);
    }

    h2 {
        text-align: center;
        color: #a020f0;
        margin-top: 0;
        margin-bottom: 25px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #111;
        border-radius: 6px;
        overflow: hidden;
    }

    th, td {
        padding: 10px 14px;
        text-align: left;
    }

    th {
        background-color: #a020f0;
        color: #fff;
        font-weight: bold;
    }

    tr:nth-child(even) {
        background-color: #1f1f1f;
    }

    tr:hover {
        background-color: #292929;
    }

    .actions {
        display: flex;
        gap: 6px;
    }

    .btn {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 13px;
        color: white;
        transition: background 0.3s;
    }

    .edit {
        background-color: #9c27b0;
    }

    .edit:hover {
        background-color: #7b1fa2;
    }

    .delete {
        background-color: #e53935;
    }

    .delete:hover {
        background-color: #c62828;
    }

    .back {
        display: block;
        text-align: center;
        margin-top: 20px;
        color: #a020f0;
        text-decoration: none;
        font-weight: 500;
    }

    .back:hover {
        color: #ff5555;
        text-decoration: underline;
    }

    .no-data {
        text-align: center;
        padding: 15px;
        color: #999;
    }
</style>
</head>
<body>
    <div class="container">
        <h2>Student Directory</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Student No</th>
                <th>Full Name</th>
                <th>Branch</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Date Added</th>
                <th>Action</th>
            </tr>

            <?php if (!empty($students)): ?>
                <?php foreach ($students as $s): ?>
                    <tr>
                        <td><?= htmlspecialchars($s['id']); ?></td>
                        <td><?= htmlspecialchars($s['student_no']); ?></td>
                        <td><?= htmlspecialchars($s['fullname']); ?></td>
                        <td><?= htmlspecialchars($s['branch']); ?></td>
                        <td><?= htmlspecialchars($s['email']); ?></td>
                        <td><?= htmlspecialchars($s['contact']); ?></td>
                        <td><?= htmlspecialchars($s['date_added']); ?></td>
                        <td class="actions">
                            <a href="update.php?id=<?= $s['id']; ?>" class="btn edit">Edit</a>
                            <a href="delete.php?id=<?= $s['id']; ?>" class="btn delete"
                               onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="8" class="no-data">No student records found.</td></tr>
            <?php endif; ?>
        </table>

        <a href="index.php" class="back">← Back to Homepage</a>
    </div>
</body>
</html>
