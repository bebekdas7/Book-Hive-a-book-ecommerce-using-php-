<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/addProduct.css">
    <title>Document</title>
</head>

<body>
    <?php
    // include the navbar
    include "../partials/nav.php";
    ?>


    <form enctype="multipart/form-data" id="postForm" class="w-75 p-4">
        <h2 class="poppins">Add Product</h2>
        <div class="mb-3">
            <label for="name" class="form-label">Book Name</label>
            <input type="text" required class="form-control" name="book_name">
        </div>

        <div class="mb-3">
            <label for="pages" class="form-label">Pages</label>
            <input type="text" required class="form-control" name="book_pages">
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" required class="form-control" name="book_category">
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" required class="form-control" name="book_author">
        </div>
        <div class="mb-3">
            <label for="publishDate" class="form-label">Publish Date</label>
            <input type="date" required class="form-control" name="book_publish_date">
        </div>
        <div class="mb-3">
            <label for="language" class="form-label">Language</label>
            <input type="text" required class="form-control" name="book_language">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text" required class="form-control" name="book_price">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" required accept=".jpg, .jpeg, .png" class="form-control" name="post_image">
        </div>

        <button type="submit" name="create_post" class="btn btn-primary">Submit</button>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js">
    </script>
    <script>
        $(document).ready(function() {
            $('#postForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    url: '../apis/addProductApi.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        console.log(data);
                        if (data.success) {
                            alert("Post created successfully");
                            window.location.href = "/admin/pages/products.php";
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