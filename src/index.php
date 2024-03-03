<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Hive</title>
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="./index.css">
</head>

<body>
    <!-- ------------including navbar-------------- -->
    <?php include_once "partials/nav.php"; ?>


    <!-- ----------------hero sectionn---------------------- -->
    <main class="hero container-fluid"></main>

    <!-- ----------------Fetures sectionn---------------------- -->
    <section class="features d-flex p-5">
        <div class="features-text px-3">
            <h1 class="poppins">Book-Hive</h1>
            <p class="mb-0 roboto">A place where we Don't Sell Books</p>
            <p class="mb-0 roboto">We Worship Them</p>
        </div>
    </section>

    <!-- ----------------Categories sectionn---------------------- -->
    <section class="categories-main container-fluid d-flex flex-column align-items-center justify-content-center p-3">
        <h3 class="mb-0">EXPLORE CATEGORIES</h3>

        <main class="categories d-flex justify-content-center align-items-center gap-4">
            <a href="./pages/novel.php" class="cat-items">
                <img src="./public/images/novel.png" alt="novel image">
            </a>
            <a href="./pages/fairytale.php" class="cat-items">
                <img src="./public/images/fairytale.png" alt="novel image">
            </a>
            <a href="./pages/satire.php" class="cat-items">
                <img src="./public/images/satire.png" alt="novel image">
            </a>
            <a href="./pages/diary.php" class="cat-items">
                <img src="./public/images/diary.png" alt="novel image">
            </a>
        </main>
    </section>

    <!-- ------------bootstrap js-------------- -->
    <script src="../vendor/twbs/bootstrap/dist/js/bootstrap.js"></script>
</body>

</html>