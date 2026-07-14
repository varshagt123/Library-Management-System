<?php include 'db.php'; ?>

<?php

$id = $_GET['id'];

$result = mysqli_query($conn,
"SELECT * FROM books WHERE book_id='$id'");

$row = mysqli_fetch_assoc($result);

if(isset($_POST['update_book'])){

    $title=$_POST['title'];
$author=$_POST['author'];
$genre=$_POST['genre'];
$total=$_POST['total_copies'];

if(!preg_match("/^[A-Za-z0-9 &+.-]+$/", $title)){

    echo "
    <div class='alert alert-danger'>
       Invalid book title
    </div>";

}

elseif(!preg_match("/^[A-Za-z ]+$/", $author)){

    echo "
    <div class='alert alert-danger'>
        Author name should contain only alphabets
    </div>";

}

elseif(!preg_match("/^[A-Za-z ]+$/", $genre)){

    echo "
    <div class='alert alert-danger'>
        Genre should contain only alphabets
    </div>";

}

else{

    mysqli_query($conn,
    "UPDATE books SET

    

    title='$title',
    author='$author',
    genre='$genre',
    total_copies='$total',
    available_copies='$total'

    WHERE book_id='$id'");

    header("Location: books.php");
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<title>Edit Book</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#d8e4f0;
    font-family:Arial;
    padding:40px;
}

.card{
    max-width:600px;
    margin:auto;
    padding:30px;
    border-radius:15px;
}

</style>

</head>

<body>

<div class="card shadow bg-white">

<h3 class="mb-4">
    Edit Book
</h3>

<form method="POST">

    <div class="mb-3">

        <label>Title</label>

        <input type="text"
name="title"
class="form-control"
value="<?php echo $row['title']; ?>"
pattern="[A-Za-z0-9 &+.-]+"
title="Enter valid book title"
required>

    </div>

    <div class="mb-3">

        <label>Author</label>
<input type="text"
name="author"
class="form-control"
value="<?php echo $row['author']; ?>"
pattern="[A-Za-z ]+"
title="Only alphabets allowed"
required>

    </div>

    <div class="mb-3">

        <label>Genre</label>

       <input type="text"
name="genre"
class="form-control"
value="<?php echo $row['genre']; ?>"
pattern="[A-Za-z ]+"
title="Only alphabets allowed"
required>

    </div>

    <div class="mb-3">

        <label>Total Copies</label>

        <input type="number"
        name="total_copies"
        class="form-control"
        value="<?php echo $row['total_copies']; ?>">

    </div>

    <button type="submit"
    name="update_book"
    class="btn btn-primary">

        Update Book

    </button>

    <a href="books.php"
    class="btn btn-secondary">

        Cancel

    </a>

</form>

</div>

</body>
</html>