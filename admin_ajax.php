<?php
include 'config.php';

$action = $_POST['action'] ?? '';

if ($action === 'getUsers') {
    getUsers();
} elseif ($action === 'editUser') {
    $username = $_POST['username'] ?? '';
    editUser($username);
} elseif ($action === 'deleteUser') {
    $username = $_POST['username'] ?? '';
    deleteUser($username);
}

function getUsers()
{
    global $conn;

    $result = $conn->query("SELECT * FROM user");

    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>Username</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Birthday</th><th>Actions</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['username']) . '</td>';
            echo '<td>' . htmlspecialchars($row['firstname']) . '</td>';
            echo '<td>' . htmlspecialchars($row['lastname']) . '</td>';
            echo '<td>' . htmlspecialchars($row['email']) . '</td>';
            echo '<td>' . htmlspecialchars($row['birthday']) . '</td>';
            echo '<td><button onclick="editUser(\'' . $row['username'] . '\')">Edit</button>';
            echo '<button onclick="deleteUser(\'' . $row['username'] . '\')">Delete</button></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'No users found.';
    }
}


function editUser($username)
{
    global $conn;

    // You should implement proper validation and sanitization here for security reasons.

    $result = $conn->query("SELECT * FROM user WHERE username = '$username'");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo 'User not found.';
    }
}

function deleteUser($username)
{
    global $conn;

    // You should implement proper validation and sanitization here for security reasons.

    $sql = "DELETE FROM user WHERE username = '$username'";

    if ($conn->query($sql) === TRUE) {
        echo 'User deleted successfully.';
    } else {
        echo 'Error deleting user: ' . $conn->error;
    }
}
?>
