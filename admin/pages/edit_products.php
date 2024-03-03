<?php
// include the navbar
include "../partials/nav.php";
include_once "../../src/classes/db.php";

$bookId = $bookName = $bookPages = $bookCategory = $bookAuthor = $bookPublishDate = $bookLanguage = $bookPrice = $bookImage = "";

if (isset($_GET['pid'])) {
    $bookId = $_GET['pid'];

    //connections
    $conn = new db("localhost", "root", "", "bookstore");
    $connDB = $conn->getConnection();

    $sql = "SELECT * FROM `book` WHERE `book_id`='$bookId'";
    $result = mysqli_query($connDB, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $bookId = $row['book_id'];
        $bookName = $row['book_name'];
        $bookPages = $row['book_pages'];
        $bookCategory = $row['book_category'];
        $bookAuthor = $row['book_author'];
        $bookPublishDate = $row['book_publish_date'];
        $bookLanguage = $row['book_language'];
        $bookPrice = $row['book_price'];
        $bookImage = $row['book_image'];
    }
}
?>

<form enctype="multipart/form-data" id="postForm" class="w-75 p-4">
    <h2 class="poppins">Edit Product</h2>
    <input type="hidden" value="<?php echo $bookId ?>" name="book_id">
    <div class="mb-3">
        <label for="name" class="form-label">Book Name</label>
        <input type="text" value="<?php echo $bookName; ?>" required class="form-control" name="book_name">
    </div>

    <div class="mb-3">
        <label for="pages" class="form-label">Pages</label>
        <input type="text" value="<?php echo $bookPages; ?>" required class="form-control" name="book_pages">
    </div>

    <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <input type="text" value="<?php echo $bookCategory; ?>" required class="form-control" name="book_category">
    </div>
    <div class="mb-3">
        <label for="author" class="form-label">Author</label>
        <input type="text" value="<?php echo $bookAuthor; ?>" required class="form-control" name="book_author">
    </div>
    <div class="mb-3">
        <label for="publishDate" class="form-label">Publish Date</label>
        <input type="date" value="<?php echo $bookPublishDate; ?>" required class="form-control" name="book_publish_date">
    </div>
    <div class="mb-3">
        <label for="language" class="form-label">Language</label>
        <input type="text" value="<?php echo $bookLanguage; ?>" required class="form-control" name="book_language">
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="text" value="<?php echo $bookPrice; ?>" required class="form-control" name="book_price">
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
                url: '../apis/editProductApi.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    console.log(data)

                    if (data.success) {
                        alert("Product updated successfully");
                        window.location.href = "/admin/pages/products.php";
                    } else {
                        alert(data.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr, status);
                    alert("Error: " + error);
                }
            });
        });
    });
</script>