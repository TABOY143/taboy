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

// Query to fetch student records specific to the logged-in teacher
$sql = "SELECT id, student_name, course, contact_number, gender, year 
        FROM students 
        WHERE TeacherID = :teacherID"; // Ensure the TeacherID column exists in the students table
$stmt = $pdo->prepare($sql);
$stmt->execute([':teacherID' => $teacherID]);

// Query to count the total number of students for the logged-in teacher
$countSql = "SELECT COUNT(*) FROM students WHERE TeacherID = :teacherID";
$countStmt = $pdo->prepare($countSql);
$countStmt->execute([':teacherID' => $teacherID]);
$totalStudents = $countStmt->fetchColumn();
?>

<div class="content">
    <h2>Student Records</h2>
    <p><strong>Total Students: <?php echo $totalStudents; ?></strong></p> <!-- Display total students -->

    <?php if ($stmt->rowCount() > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Course</th>
                    <th>Year</th>
                    <th>Contact Number</th>
                    <th>Gender</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['course']); ?></td>
                        <td><?php echo htmlspecialchars($row['year']); ?></td>
                        <td><?php echo htmlspecialchars($row['contact_number']); ?></td>
                        <td><?php echo htmlspecialchars($row['gender']); ?></td>
                        <td>
                            <a href="edit_student.php?id=<?php echo $row['id']; ?>" class="edit-btn">Edit</a> |
                            <a href="delete_student.php?id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirmDelete()">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No records found.</p>
    <?php endif; ?>
</div>

<script>
    // JavaScript for delete confirmation
    function confirmDelete() {
        return confirm('Are you sure you want to delete this student?');
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
        max-width: 900px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #333;
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table th, table td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }

    table th {
        background-color: #4CAF50;
        color: white;
    }

    table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    table tr:hover {
        background-color: #f1f1f1;
    }

    .edit-btn, .delete-btn {
        color: #007bff;
        text-decoration: none;
        padding: 5px 10px;
        border-radius: 4px;
    }

    .edit-btn:hover {
        background-color: #e7f3fe;
    }

    .delete-btn {
        color: #ff0000;
    }

    .delete-btn:hover {
        background-color: #ffe6e6;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        table {
            font-size: 0.9em;
        }

        table th, table td {
            padding: 8px;
        }

        .content {
            padding: 15px;
            margin: 10px;
        }
    }
</style>

</body>
</html>
