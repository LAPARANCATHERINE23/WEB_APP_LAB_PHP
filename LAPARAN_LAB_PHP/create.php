<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if (!empty($name) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        try {
            // Prepared statement using "?" as placeholders
            $stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
            $stmt->bind_param("ss", $name, $email);
            $stmt->execute();

            echo "User registered successfully! ID: " . $stmt->insert_id;
            $stmt->close();

        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) {
                echo "Error: That email address is already registered.";
            } else {
                echo "An error occurred while saving data.";
            }
        }
    } else {
        echo "Please provide a valid name and email address.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
</head>
<body>
    <h2>Create New User</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required><br><br>
        <input type="email" name="email" placeholder="Email Address" required><br><br>
        <button type="submit">Create User</button>
    </form>
    <p><a href="read.php">View Users List</a></p>
</body>
</html>
<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if (!empty($name) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        try {
            // Prepared statement using "?" as placeholders
            $stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
            $stmt->bind_param("ss", $name, $email);
            $stmt->execute();

            echo "User registered successfully! ID: " . $stmt->insert_id;
            $stmt->close();

        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) {
                echo "Error: That email address is already registered.";
            } else {
                echo "An error occurred while saving data.";
            }
        }
    } else {
        echo "Please provide a valid name and email address.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
</head>
<body>
    <h2>Create New User</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required><br><br>
        <input type="email" name="email" placeholder="Email Address" required><br><br>
        <button type="submit">Create User</button>
    </form>
    <p><a href="read.php">View Users List</a></p>
</body>
</html>
