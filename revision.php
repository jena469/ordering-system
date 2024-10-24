<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>User Management</h2>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#userModal" onclick="prepareAdd()">Add User</button>

    <!-- User Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="userForm" method="post" action="process.php">
                    <div class="modal-body">
                        <input type="hidden" id="userId" name="id">
                        <div class="form-group">
                            <label for="userName">Name:</label>
                            <input type="text" class="form-control" id="userName" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="userEmail">Email:</label>
                            <input type="email" class="form-control" id="userEmail" name="email" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="userSubmit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Display Users -->
    <?php
    $sql = "SELECT id, name, email FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table class='table mt-4'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>
                        <button class='btn btn-warning btn-sm' onclick='prepareUpdate({$row['id']}, \"{$row['name']}\", \"{$row['email']}\")'>Edit</button>
                        <a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
                    </td>
                  </tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>No users found.</p>";
    }

    $conn->close();
    ?>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
function prepareAdd() {
    $('#userForm').attr('action', 'process.php');
    $('#userModalLabel').text('Add User');
    $('#userId').val('');
    $('#userName').val('');
    $('#userEmail').val('');
    $('#userSubmit').text('Save');
}

function prepareUpdate(id, name, email) {
    $('#userForm').attr('action', 'process.php');
    $('#userModalLabel').text('Update User');
    $('#userId').val(id);
    $('#userName').val(name);
    $('#userEmail').val(email);
    $('#userSubmit').text('Update');
    $('#userModal').modal('show');
}
</script>

</body>
</html>
