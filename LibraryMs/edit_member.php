
<?php include 'db.php'; ?>

<?php

$id = $_GET['id'];

$result = mysqli_query($conn,
"SELECT * FROM members WHERE member_id='$id'");

$row = mysqli_fetch_assoc($result);

if(isset($_POST['update_member'])){

    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $join_date=$_POST['join_date'];

    if(!preg_match("/^[A-Za-z ]+$/",$name)){

        echo "
        <div class='alert alert-danger'>
            Only alphabets allowed in name
        </div>";
    }

    else{

        if(strlen($phone)!=10){

            echo "
            <div class='alert alert-danger'>
                Phone number must be 10 digits
            </div>";
        }

        else{

            $check=mysqli_query($conn,

            "SELECT * FROM members

            WHERE
            (email='$email'
            OR phone='$phone')

            AND member_id!='$id'");

            if(mysqli_num_rows($check)>0){

                echo "
                <div class='alert alert-danger'>
                    Email or Phone already exists
                </div>";
            }

            else{

                mysqli_query($conn,
                "UPDATE members SET

                name='$name',
                email='$email',
                phone='$phone',
                join_date='$join_date'

                WHERE member_id='$id'");

                header("Location: members.php");
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

<title>Edit Member</title>

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
    Edit Member
</h3>

<form method="POST">

    <div class="mb-3">

        <label>Name</label>

        <input type="text"
        name="name"
        class="form-control"
        value="<?php echo $row['name']; ?>">

    </div>

    <div class="mb-3">

        <label>Email</label>

        <input type="email"
        name="email"
        class="form-control"
        value="<?php echo $row['email']; ?>">

    </div>

    <div class="mb-3">

        <label>Phone</label>

        <input type="text"
        name="phone"
        class="form-control"
        value="<?php echo $row['phone']; ?>">

    </div>

    <div class="mb-3">

        <label>Join Date</label>

        <input type="date"
        name="join_date"
        class="form-control"
        value="<?php echo $row['join_date']; ?>">

    </div>

    <button type="submit"
    name="update_member"
    class="btn btn-update">

        Update Member

    </button>

    <a href="members.php"
    class="btn btn-secondary">

        Cancel

    </a>

</form>

</div>

</body>
</html>