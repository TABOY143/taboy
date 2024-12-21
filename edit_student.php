<?php
// Include the header and database connection
include 'plugin/header.php';
include 'db.php';

// Get the student ID from the query string
$id = $_GET['id'] ?? '';

if (!$id) {
    die('Invalid student ID.');
}

// Fetch the student details
$sql = "SELECT * FROM students WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    die('Student not found.');
}

// Handle form submission to update the student
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_name = $_POST['student_name'] ?? '';
    $contact_number = $_POST['contact_number'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $year = $_POST['year'] ?? '';

    if (!empty($student_name) && !empty($contact_number) && !empty($gender) && !empty($year)) {
        $sql = "UPDATE students SET student_name = :student_name, contact_number = :contact_number, gender = :gender, year = :year WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':student_name' => $student_name,
            ':contact_number' => $contact_number,
            ':gender' => $gender,
            ':year' => $year,
            ':id' => $id
        ]);
        echo "<p class='success-message'>Student updated successfully!</p>";
    } else {
        echo "<p class='error-message'>Please fill in all fields!</p>";
    }
}
?>

<div class="content">
    <h2>Edit Student</h2>
    <form method="POST" action="" onsubmit="return validateForm()">
        <label for="student_name">Name:</label><br>
        <input type="text" id="student_name" name="student_name" value="<?php echo htmlspecialchars($student['student_name']); ?>" required><br><br>

        <label for="contact_number">Contact Number:</label><br>
        <input type="text" id="contact_number" name="contact_number" value="<?php echo htmlspecialchars($student['contact_number']); ?>" required><br><br>

        <label for="gender">Gender:</label><br>
        <select id="gender" name="gender" required>
            <option value="Male" <?php if ($student['gender'] === 'Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if ($student['gender'] === 'Female') echo 'selected'; ?>>Female</option>
            <option value="Other" <?php if ($student['gender'] === 'Other') echo 'selected'; ?>>Other</option>
        </select><br><br>

        <button type="submit">Update Student</button>
    </form>
</div>

<script>
    // JavaScript for form validation
    function validateForm() {
        const name = document.getElementById('student_name').value;
        const contactNumber = document.getElementById('contact_number').value;
        const year = document.getElementById('year').value;

        if (name.trim() === "" || contactNumber.trim() === "" || year.trim() === "") {
            alert("Please fill in all required fields.");
            return false;
        }
        return true;
    }
</script>

<style>
    /* Basic Styling */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .content {
        background-color: #ffffff;
        padding: 20px;
        margin: 20px auto;
        max-width: 600px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #333;
    }

    label {
        font-size: 1.1em;
        color: #555;
    }

    input[type="text"], select {
        width: 100%;
        padding: 10px;
        margin: 8px 0;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1em;
    }

    button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        font-size: 1.1em;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #45a049;
    }

    .success-message {
        color: green;
        font-size: 1.1em;
    }

    .error-message {
        color: red;
        font-size: 1.1em;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .content {
            padding: 15px;
            margin: 10px;
        }

        button {
            width: 100%;
        }
    }
</style>

</body>
</html>
