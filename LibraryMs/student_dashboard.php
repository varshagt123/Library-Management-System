<?php

session_start();

include 'db.php';

if(!isset($_SESSION['role'])){

    header("Location: login.php");

    exit();
}

if($_SESSION['role'] != 'student'){

    header("Location:index.php");

    exit();
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<title>Student Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{

background:#d8e4f0;
padding:30px;
font-family:Arial;

}

.card{

background:white;
padding:20px;
border-radius:12px;

}

</style>

</head>

<body>

<h2 class="mb-4">

Welcome Student 📚

</h2>

<a href="logout.php"
class="btn btn-danger mb-3">

Logout

</a>

<div class="card">

<h4 class="mb-3">

Available Books

</h4>

<table class="table table-bordered">

<tr>

<th>Title</th>

<th>Author</th>

<th>Genre</th>

<th>Available Copies</th>

</tr>

<?php

$result = mysqli_query($conn,

"SELECT * FROM books");

while($row=mysqli_fetch_assoc($result)){

echo "

<tr>

<td>{$row['title']}</td>

<td>{$row['author']}</td>

<td>{$row['genre']}</td>

<td>{$row['available_copies']}</td>

</tr>";
}

?>

</table>

</div>

</body>

</html>