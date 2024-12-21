<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the input password
    $passwordHash = hash('sha256', $password);

    // Check if the teacher exists
    try {
        $stmt = $pdo->prepare("SELECT TeacherID, FullName, Email, PasswordHash, CreatedAt FROM Teachers WHERE Email = :email AND PasswordHash = :passwordHash");
        $stmt->execute(['email' => $email, 'passwordHash' => $passwordHash]);
        $teacher = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($teacher) {
            // Store user data in the session
            session_start();
            $_SESSION['TeacherID'] = $teacher['TeacherID'];
            $_SESSION['FullName'] = $teacher['FullName'];
            $_SESSION['Email'] = $teacher['Email'];

            // Redirect to dashboard
            header("Location: user_dashboard.php");
            exit();
        } else {
            $errorMessage = "Invalid email or password.";
        }
    } catch (PDOException $e) {
        $errorMessage = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="form-container">
    <h2>Teacher Login</h2>
    <?php if (isset($errorMessage)): ?>
        <div class="error-message"><?php echo $errorMessage; ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <div class="input-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="input-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" name="login" class="submit-btn">Login</button>
    </form>

    <p>Already have an account? <a href="register.php">Register here</a></p>
</div>

</body>
</html>
