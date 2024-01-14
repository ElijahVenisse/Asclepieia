<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        /* Include your necessary styles here */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
            text-align: left;
        }

        th, td {
            padding: 10px;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2>User Management</h2>

<!-- Display user table here -->
<div id="userTable"></div>

<script>
    $(document).ready(function () {
        // Load user table on page load
        loadUserTable();
    });

    function loadUserTable() {
        $.ajax({
            url: 'admin_ajax.php',
            type: 'GET',
            data: {action: 'getUsers'},
            success: function (response) {
                $('#userTable').html(response);
            }
        });
    }

  // Update the editUser function
function editUser(username) {
    $.ajax({
        type: 'POST',
        url: 'admin_ajax.php',
        data: { action: 'editUser', username: username },
        dataType: 'json',
        success: function (data) {
            // Populate your form fields with the data received from the server
            // Example assuming you have input fields with ids 'editUsername', 'editFirstName', etc.
            $('#editUsername').val(data.username);
            $('#editFirstName').val(data.firstname);
            // Repeat for other fields...
        },
        error: function (xhr, status, error) {
            console.error('Error fetching user data:', error);
        }
    });
}

// Update the deleteUser function
function deleteUser(username) {
    if (confirm('Are you sure you want to delete this user?')) {
        $.ajax({
            type: 'POST',
            url: 'admin_ajax.php',
            data: { action: 'deleteUser', username: username },
            success: function (data) {
                console.log(data);
                // Refresh the user table or handle the UI accordingly
                getUsers();
            },
            error: function (xhr, status, error) {
                console.error('Error deleting user:', error);
            }
        });
    }
}

</script>

</body>
</html>
