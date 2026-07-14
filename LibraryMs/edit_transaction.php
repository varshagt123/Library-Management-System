<?php include 'db.php'; ?>

<?php

$id = $_GET['id'];

$result = mysqli_query($conn,
"SELECT * FROM transactions
WHERE transaction_id='$id'");

$row = mysqli_fetch_assoc($result);

if(isset($_POST['update_transaction'])){

    $member_id=$_POST['member_id'];
    $book_id=$_POST['book_id'];
    $issue_date=$_POST['issue_date'];
    $return_date=$_POST['return_date'];

    mysqli_query($conn,
    "UPDATE transactions SET

    member_id='$member_id',
    book_id='$book_id',
    issue_date='$issue_date',
    return_date='$return_date'

    WHERE transaction_id='$id'");

    header("Location: transactions.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<title>Edit Transaction</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#d8e4f0;
    font-family:Arial;
    padding:40px;
}

.card{
    max-width:700px;
    margin:auto;
    padding:30px;
    border-radius:15px;
}

.btn-update{
    background:#f59e0b;
    color:#fff;
    border:none;
}

.btn-update:hover{
    background:#d97706;
    color:#fff;
}

</style>

</head>

<body>

<div class="card shadow bg-white">

<h3 class="mb-4">
    Edit Transaction
</h3>

<form method="POST">

    <div class="mb-3">

        <label>Member</label>

        <select name="member_id"
        class="form-control">

        <?php

        $members=mysqli_query($conn,
        "SELECT * FROM members");

        while($m=mysqli_fetch_assoc($members)){

            $selected = ($m['member_id']==$row['member_id'])
            ? "selected" : "";

            echo "
            <option value='{$m['member_id']}'
            $selected>

                {$m['name']}

            </option>";
        }

        ?>

        </select>

    </div>

    <div class="mb-3">

        <label>Book</label>

        <select name="book_id"
        class="form-control">

        <?php

        $books=mysqli_query($conn,
        "SELECT * FROM books");

        while($b=mysqli_fetch_assoc($books)){

            $selected = ($b['book_id']==$row['book_id'])
            ? "selected" : "";

            echo "
            <option value='{$b['book_id']}'
            $selected>

                {$b['title']}

            </option>";
        }

        ?>

        </select>

    </div>

    <div class="mb-3">

        <label>Issue Date</label>

        <input type="date"
        name="issue_date"
        class="form-control"
        value='<?php echo $row['issue_date']; ?>'>

    </div>

    <div class="mb-3">

        <label>Return Date</label>

        <input type="date"
        name="return_date"
        class="form-control"
        value='<?php echo $row['return_date']; ?>'>

    </div>

    <button type="submit"
    name="update_transaction"
    class="btn btn-update">

        Update Transaction

    </button>

    <a href="transactions.php"
    class="btn btn-secondary">

        Cancel

    </a>

</form>

</div>
<script>

document.querySelector("[name='issue_date']")
.addEventListener("change", function(){

    let issueDate = new Date(this.value);

    issueDate.setDate(issueDate.getDate() + 15);

    let year = issueDate.getFullYear();

    let month =
    String(issueDate.getMonth()+1).padStart(2,'0');

    let day =
    String(issueDate.getDate()).padStart(2,'0');

    let finalDate =
    year + "-" + month + "-" + day;

    document.querySelector("[name='return_date']").value
    = finalDate;

});

</script>
</body>
</html>