<?php
session_start();
include 'db.php';

if(isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if(!preg_match("/^[A-Za-z]+$/", $username)){

        $error = "Username should contain only alphabets";

    }

    elseif(strlen($username) > 10){

        $error = "Username maximum 10 characters only";

    }

 elseif(!preg_match(
"/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8}$/",
$password
)){

    $error = "Password must contain uppercase, lowercase, number and special character";

}
    else{
$query = mysqli_query($conn,

"SELECT * FROM users

WHERE username='$username'

AND password='$password'");

if(mysqli_num_rows($query) > 0){

    $user = mysqli_fetch_assoc($query);

    $_SESSION['role'] = $user['role'];

    $_SESSION['username'] = $user['username'];

    if($user['role'] == 'librarian'){

        header("Location:index.php");

    }

    else{

        header("Location:student_dashboard.php");
    }

    exit();
}

else{

    $error = "Invalid username or password!";
}
       
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Login | LibraryMS</title>

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
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .login-card{

            width:400px;
            background:#fff;
            padding:40px;
            border-radius:20px;
            box-shadow:0 10px 30px rgba(0,0,0,0.1);
        }

        .logo{

            text-align:center;
            margin-bottom:30px;
        }

        .logo h2{

            color:#2e5b8a;
            font-weight:700;
            margin-bottom:8px;
        }

        .logo p{

            color:#5a7a9a;
            font-size:14px;
        }

        .form-label{

            font-size:13px;
            font-weight:600;
            color:#2e5b8a;
            margin-bottom:8px;
        }

        .form-control{

            border:2px solid #d8e4f0;
            border-radius:12px;
            padding:12px;
            font-size:14px;
            margin-bottom:18px;
        }

        .form-control:focus{

            border-color:#2e5b8a;
            box-shadow:none;
        }

        .btn-login{

            width:100%;
            background:#2e5b8a;
            color:#fff;
            border:none;
            border-radius:12px;
            padding:12px;
            font-weight:600;
            transition:0.2s;
        }

        .btn-login:hover{

            background:#1f456d;
        }

        .error-box{

            background:#fee2e2;
            color:#dc2626;
            padding:12px;
            border-radius:10px;
            font-size:14px;
            margin-bottom:20px;
            text-align:center;
        }

       
    </style>

</head>

<body>

    <div class="login-card">

        <div class="logo">

            <h2>📚 LibraryMS</h2>

            <p>Library Management System</p>

        </div>

        <?php

        if(isset($error)){

            echo "<div class='error-box'>
                    <i class='fas fa-circle-exclamation me-2'></i>
                    $error
                  </div>";
        }

        ?>

        <form method="POST">

            <label class="form-label">
                Username
            </label>

         <input type="text"
       name="username"
       class="form-control"
       placeholder="Enter username"
       maxlength="10"
       pattern="[A-Za-z]+"
       title="Username should contain only alphabets"
       required>

            <label class="form-label">
                Password
            </label>

<input type="password"
       name="password"
       class="form-control"
       placeholder="Enter password"

       minlength="8"
       maxlength="8"

       pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8}"

       title="Password must be exactly 8 characters with uppercase, lowercase, number and special character"

       required>
       <div class="form-check mb-3">

    <input type="checkbox"
           class="form-check-input"
           id="showPassword">

    <label class="form-check-label"
           for="showPassword">

        Show Password

    </label>

</div>
            <button type="submit"
                    name="login"
                    class="btn-login">

                <i class="fas fa-right-to-bracket me-2"></i>
                Login

            </button>

        </form>

        

    </div>

<script>

document.getElementById("showPassword").addEventListener("change", function(){

    let passwordField = document.querySelector('input[name="password"]');

    if(this.checked){

        passwordField.type = "text";

    }

    else{

        passwordField.type = "password";
    }
});

</script>

</body>
</html>
