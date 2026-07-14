<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>

    <title>Members | LibraryMS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Inter',sans-serif;
            background:#d8e4f0;
            color:#1a3a5c;
            display:flex;
            min-height:100vh;
        }

        .sidebar{
            width:250px;
            background:#2e5b8a;
            position:fixed;
            height:100vh;
            display:flex;
            flex-direction:column;
        }

        .sidebar-logo{
            padding:24px 20px;
            border-bottom:1px solid #3a6fa0;
        }

        .sidebar-logo h4{
            color:#fff;
            font-size:18px;
            font-weight:700;
            margin:0;
        }

        .sidebar-logo span{
            color:#a0bcd8;
            font-size:12px;
        }

        .nav-label{
            padding:20px 20px 8px;
            color:#7aabcc;
            font-size:10px;
            font-weight:600;
            letter-spacing:1.5px;
            text-transform:uppercase;
        }

        .sidebar a{
            display:flex;
            align-items:center;
            gap:12px;
            padding:12px 20px;
            color:#a0bcd8;
            text-decoration:none;
            font-size:14px;
            font-weight:500;
            transition:all 0.2s;
            border-left:3px solid transparent;
        }

        .sidebar a:hover{
            background:#3a6fa0;
            color:#fff;
        }

        .sidebar a.active{
            background:#3a6fa0;
            color:#fff;
            border-left:3px solid #63b3ed;
        }

        .sidebar-footer{
            margin-top:auto;
            padding:16px;
            border-top:1px solid #3a6fa0;
        }

        .sidebar-footer a{
            color:#fc8181;
        }

        .main{
            margin-left:250px;
            flex:1;
            padding:30px;
        }

        .topbar{
            background:#fff;
            padding:16px 24px;
            border-radius:12px;
            box-shadow:0 2px 8px rgba(0,0,0,0.08);
            margin-bottom:24px;
            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        .topbar h5{
            font-size:20px;
            font-weight:700;
            margin:0;
        }

        .card-main{
            background:#fff;
            border-radius:14px;
            padding:24px;
            box-shadow:0 2px 8px rgba(0,0,0,0.08);
            margin-bottom:20px;
        }

        .card-main h6{
            font-size:15px;
            font-weight:700;
            margin-bottom:16px;
            padding-bottom:12px;
            border-bottom:2px solid #d8e4f0;
        }

        .table th{
            font-size:11px;
            font-weight:600;
            text-transform:uppercase;
            letter-spacing:0.8px;
            color:#5a7a9a;
            border-bottom:2px solid #d8e4f0;
            padding:10px 12px;
        }

        .table td{
            font-size:14px;
            color:#2e5b8a;
            border-bottom:1px solid #e8f0f8;
            padding:12px;
            vertical-align:middle;
        }

        .form-control{
            border-radius:10px;
            padding:10px;
        }

        .btn-custom{
            background:#2e5b8a;
            color:#fff;
            border:none;
            padding:10px 18px;
            border-radius:10px;
            font-weight:600;
        }

        .btn-custom:hover{
            background:#1f456d;
        }

        .btn-edit{
    background:#f59e0b;
    color:#fff;
    border:none;
    padding:6px 12px;
    border-radius:8px;
    margin-right:8px;
}

.btn-edit:hover{
    background:#d97706;
}

.btn-delete{
    background:#ef4444;
    color:#fff;
    border:none;
    padding:6px 12px;
    border-radius:8px;
}

.btn-delete:hover{
    background:#dc2626;
}

        .btn-delete{
            background:#ef4444;
            color:#fff;
            border:none;
            padding:6px 12px;
            border-radius:8px;
        }

    </style>

</head>

<body>

<div class="sidebar">

    <div class="sidebar-logo">
        <h4>📚 LibraryMS</h4>
        <span>Management System</span>
    </div>

    <div class="nav-label">Main Menu</div>

    <a href="index.php">
        <i class="fas fa-chart-pie"></i> Dashboard
    </a>

    <a href="books.php">
        <i class="fas fa-book"></i> Books
    </a>

    <a href="members.php" class="active">
        <i class="fas fa-users"></i> Members
    </a>

    <a href="transactions.php">
        <i class="fas fa-exchange-alt"></i> Transactions
    </a>

    <a href="fines.php">
        <i class="fas fa-rupee-sign"></i> Fines
    </a>

    <div class="sidebar-footer">
        <a href="logout.php">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>

</div>

<div class="main">

    <div class="topbar">

        <div>
            <h5>Members</h5>

            <small style="color:#5a7a9a;">
                Manage library members
            </small>
        </div>

        <span style="background:#d8e4f0;
        padding:8px 16px;
        border-radius:20px;
        font-size:13px;
        color:#2e5b8a;
        font-weight:500;">

            <i class="fas fa-calendar me-2"></i>

            <?php echo date('d M Y'); ?>

        </span>

    </div>
<?php

if(isset($_GET['msg'])){

    if($_GET['msg']=="added"){
        echo "
        <div class='alert alert-success' id='successAlert'>
            Member Added Successfully
        </div>";
    }

 elseif($_GET['msg']=="deleted"){
    echo "
    <div class='alert alert-danger' id='deleteAlert'>
        Member Deleted Successfully
    </div>";
}

elseif($_GET['msg']=="duplicate"){
    echo "
    <div class='alert alert-danger' id='duplicateAlert'>
        Member is already registered
    </div>";
}

}

?>
    <?php

    if(isset($_POST['add_member'])){

       $name=$_POST['name'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$join_date=$_POST['join_date'];

if(!preg_match("/^[A-Za-z ]+$/", $name)){

    echo "
    <div class='alert alert-danger'>
        Name should contain only alphabets
    </div>";

}

elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){

    echo "
    <div class='alert alert-danger'>
        Invalid email format
    </div>";

}

elseif(!preg_match("/^[0-9]{10}$/", $phone)){

    echo "
    <div class='alert alert-danger'>
        Phone number must contain exactly 10 digits
    </div>";

}

elseif(empty($join_date)){

    echo "
    <div class='alert alert-danger'>
        Please select join date
    </div>";
}
else{

    $check=mysqli_query($conn,
    "SELECT * FROM members
    WHERE email='$email' OR phone='$phone'");

    if(mysqli_num_rows($check)>0){

      
      echo "<script>
window.location='members.php?msg=duplicate';
</script>";
exit();

    }

    else{

        mysqli_query($conn,
        "INSERT INTO members(name,email,phone,join_date)

        VALUES('$name','$email','$phone','$join_date')");

        echo "<script>
        window.location='members.php?msg=added';
        </script>";
        exit();

    }

}
    

        
    }

    if(isset($_GET['delete_id'])){

    mysqli_query($conn,
    "DELETE FROM members
    WHERE member_id='{$_GET['delete_id']}'");

    echo "<script>
    window.location='members.php?msg=deleted';
    </script>";
    exit();
}

    ?>

    <div class="card-main">

        <h6>Add New Member</h6>

        <form method="POST">

            <div class="row g-3">

                <div class="col-md-3">

                   <input type="text"
name="name"
class="form-control"
placeholder="Full Name"
pattern="[A-Za-z ]+"
title="Only alphabets allowed"
required>

                </div>

                <div class="col-md-3">

                    <input type="email"
                    name="email"
                    class="form-control"
                    placeholder="Email"
                    required>

                </div>

                <div class="col-md-2">

                  <input type="text"
name="phone"
class="form-control"
placeholder="Phone"
maxlength="10"
pattern="[0-9]{10}"
title="Phone number must contain exactly 10 digits"
required>

                </div>

                <div class="col-md-2">

                   <input type="date"
name="join_date"
class="form-control"
required>

                </div>

                <div class="col-md-2">

                    <button type="submit"
                    name="add_member"
                    class="btn-custom w-100">

                        Add Member

                    </button>

                </div>

            </div>

        </form>

    </div>

    <div class="card-main">

        <h6>All Members</h6>

        <table class="table table-borderless">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Join Date</th>
                    <th>Action</th>

                </tr>

            </thead>

            <tbody>

            <?php

            $result=mysqli_query($conn,
            "SELECT * FROM members");

            while($row=mysqli_fetch_assoc($result)){

                echo "

                <tr>

                    <td>{$row['member_id']}</td>

                    <td>
                        <b>{$row['name']}</b>
                    </td>

                    <td>{$row['email']}</td>

                    <td>{$row['phone']}</td>

                    <td>{$row['join_date']}</td>

             <td>

<a href='edit_member.php?id={$row['member_id']}'>

<button class='btn-edit'>

Edit

</button>

</a>

<a href='members.php?delete_id={$row['member_id']}'
onclick='return confirm(\"Delete this member?\")'>

<button class='btn-delete'>

Delete

</button>

</a>

</td>
                </tr>";
            }

            ?>

            </tbody>

        </table>

    </div>

</div>
<script>



setTimeout(function(){

    let success=document.getElementById('successAlert');

    if(success){
        success.style.display='none';
    }

    let del=document.getElementById('deleteAlert');

    if(del){
        del.style.display='none';
    }
    let duplicate=document.getElementById('duplicateAlert');

if(duplicate){
    duplicate.style.display='none';
}

},3000);

</script>


</body>
</html>