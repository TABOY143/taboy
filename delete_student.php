<?php
// Include the database connection
include 'db.php';

// Get the student ID from the query string
$id = $_GET['id'] ?? '';

if (!$id) {
    die('Invalid student ID.');
}

// Delete the student record
$sql = "DELETE FROM students WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);

// Redirect back to the student records page
header('Location: student_records.php');
exit;
?>
