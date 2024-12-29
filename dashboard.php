<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM expenses WHERE user_id = $user_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Expense Tracker Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-between align-items-center">
            <div class="col-md-6">
                <h2>Expense Tracker</h2>
            </div>
            <div class="col-md-6 text-right">
                <a href="logout.php" class="btn btn-secondary">Logout</a>
                <a href="add_expense.php" class="btn btn-success">Add Expense</a>
            </div>
        </div>

        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= number_format($row['amount'], 2) ?></td>
                    <td><?= date('d-m-Y', strtotime($row['date'])) ?></td>
                    <td>
                        <a href="edit_expense.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_expense.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
