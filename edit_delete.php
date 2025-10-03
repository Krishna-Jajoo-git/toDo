<?php
require_once __DIR__ . "/database/db.php";

$pdo = db_connect();

// DELETE task
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $pdo->prepare("DELETE FROM todos WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: index.php?msg=Task+Deleted");
    exit;
}

// UPDATE task
if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $is_completed = isset($_POST['is_completed']) ? 1 : 0;

    $stmt = $pdo->prepare("UPDATE todos SET description = ?, due_date = ?, is_completed = ? WHERE id = ?");
    $stmt->execute([$description, $due_date, $is_completed, $id]);

    header("Location: index.php?msg=Task+Updated");
    exit;
}

// FETCH task for editing
$task = null;
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $stmt = $pdo->prepare("SELECT * FROM todos WHERE id = ?");
    $stmt->execute([$id]);
    $task = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/style.css">
    <title>Edit / Delete Task</title>
</head>
<body>
    <h1>Edit / Delete Task</h1>

    <?php if ($task): ?>
        <form method="post">
            <input type="hidden" name="id" value="<?= htmlspecialchars($task['id']) ?>">

            <p>
                <label>Description:</label><br>
                <input type="text" name="description" value="<?= htmlspecialchars($task['description']) ?>" required>
            </p>

            <p>
                <label>Due Date:</label><br>
                <input type="date" name="due_date" value="<?= htmlspecialchars($task['due_date']) ?>" required>
            </p>

            <p>
                <label>
                    <input type="checkbox" name="is_completed" value="1" <?= $task['is_completed'] ? 'checked' : '' ?>>
                    Completed
                </label>
            </p>

            <button type="submit" name="update">Update Task</button>
        </form>
    <?php else: ?>
        <p>No task selected.</p>
    <?php endif; ?>

    <p>
        <a href="index.php">Back to Task List</a>
    </p>
</body>
</html>