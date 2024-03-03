<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <title>Document</title>
</head>

<body>
    <?php
    // include the navbar
    include "../partials/nav.php";
    ?>

    <form enctype="multipart/form-data" id="postForm" class="w-75 p-4">
        <h2 class="poppins">Add Users</h2>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" required class="form-control" name="name">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" required class="form-control" name="email">
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Usernme</label>
            <input type="text" required class="form-control" name="username">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="text" required class="form-control" name="password">
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role">
                <option value="admin">Admin</option>
                <option value="suser">User</option>
            </select>
        </div>

        <button type="submit" name="create_post" class="btn btn-primary">Submit</button>
    </form>



    <script src="../../vendor/twbs/bootstrap/dist/js/bootstrap.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js">
    </script>
    <script>
        $(document).ready(function() {
            $('#postForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    url: '../apis/addUserApi.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        console.log(data);
                        if (data.success) {
                            alert("User created successfully");
                            window.location.href = "/admin/pages/users.php";
                        } else {
                            alert(data.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert(error);
                        xhr
                    }
                });
            })
        })
    </script>
</body>

</html>