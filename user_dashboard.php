<?php
// Include the header and database connection
include 'plugin/header.php';
include 'db.php';

// Start the session to get the logged-in teacher's ID
session_start();

// Check if the teacher is logged in
if (!isset($_SESSION['TeacherID'])) {
    // Redirect to login page if teacher is not logged in
    header('Location: login.php');
    exit;
}

// Get the teacher's ID from the session
$teacherID = $_SESSION['TeacherID'];

// Handle form submission to add a new student
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_name = $_POST['student_name'] ?? '';
    $contact_number = $_POST['contact_number'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $course = "IT"; // Hardcoded to IT
    $year = "1st Year"; // Hardcoded to 1st Year

    if (!empty($student_name) && !empty($contact_number) && !empty($gender)) {
        $sql = "INSERT INTO students (student_name, course, year, contact_number, gender, TeacherID) 
                VALUES (:student_name, :course, :year, :contact_number, :gender, :teacherID)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':student_name' => $student_name,
            ':course' => $course,
            ':year' => $year,
            ':contact_number' => $contact_number,
            ':gender' => $gender,
            ':teacherID' => $teacherID // Associate the student with the logged-in teacher
        ]);
        echo "<p class='success-message'>Student added successfully!</p>";
    } else {
        echo "<p class='error-message'>Please fill in all fields!</p>";
    }
}
?>

<div class="content">
    <h2>Student Dashboard</h2>

    <!-- Form to Add a Student -->
    <h3>Add a New Student</h3>
    <form method="POST" action="" onsubmit="return validateForm()">
        <label for="student_name">Name:</label><br>
        <input type="text" id="student_name" name="student_name" required><br><br>

        <label for="contact_number">Contact Number:</label><br>
        <input type="text" id="contact_number" name="contact_number" required><br><br>

        <label for="gender">Gender:</label><br>
        <select id="gender" name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select><br><br>

        <!-- Display Hardcoded Course and Year -->
        <p>Course: <strong>IT</strong></p>
        <p>Year: <strong>1st Year</strong></p>

        <button type="submit">Add Student</button>
    </form>
</div>

<script>
    // JavaScript for form validation
    function validateForm() {
        const name = document.getElementById('student_name').value;
        const contactNumber = document.getElementById('contact_number').value;

        if (name.trim() === "" || contactNumber.trim() === "") {
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

    h2, h3 {
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
    @media (max-width: 600px) {
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
