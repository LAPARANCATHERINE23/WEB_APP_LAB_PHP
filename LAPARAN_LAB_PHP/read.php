<?php
require_once 'config.php';

$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);
if (!$id) {
    die("Invalid or missing User ID.");
}

// 1. Fetch current user data to populate the form
try {
    $stmt = $conn->prepare("SELECT name, email FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if (!$user) {
        die("User record not found.");
    }
} catch (mysqli_sql_exception $e) {
    die("Database error occurred.");
}

// 2. Handle the update submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if (!empty($name) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        try {
            $stmt = $conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
            $stmt->bind_param("ssi", $name, $email, $id);
            $stmt->execute();
            $stmt->close();

            header("Location: read.php");
            exit;
        } catch (mysqli_sql_exception $e) {
            echo "Error updating record.";
        }
    } else {
        echo "Please provide valid information.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
</head>
<body>
    <h2>Update User</h2>
    <form method="POST">
        <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required><br><br>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br><br>
        <button type="submit">Update User</button>
    </form>
    <p><a href="read.php">Cancel</a></p>
</body>
</html>