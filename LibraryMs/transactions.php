<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include 'db.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>

    <title>Transactions | LibraryMS</title>

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
            z-index:100;
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

        .sidebar a i{
            width:18px;
        }

        .sidebar-footer{
            margin-top:auto;
            padding:16px;
            border-top:1px solid #3a6fa0;
        }

        .sidebar-footer a{
            display:flex;
            align-items:center;
            gap:12px;
            padding:10px 16px;
            color:#fc8181;
            text-decoration:none;
            border-radius:8px;
            font-size:14px;
            transition:all 0.2s;
        }

        .sidebar-footer a:hover{
            background:#fc818120;
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
            color:#1a3a5c;
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
            color:#1a3a5c;
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

        .form-control,
        .form-select{
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

    <a href="members.php">
        <i class="fas fa-users"></i> Members
    </a>

    <a href="transactions.php" class="active">
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
            <h5>Transactions</h5>

            <small style="color:#5a7a9a;">
                Issue and manage books
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

    if($_GET['msg']=="deleted"){

        echo "
        <div class='alert alert-danger' id='deleteTransactionAlert'>
            Transaction Deleted Successfully
        </div>";
    }

    elseif($_GET['msg']=="issued"){

        echo "
        <div class='alert alert-success' id='issueAlert'>
            Book Issued Successfully
        </div>";
    }
    elseif($_GET['msg']=="duplicate"){

    echo "
    <div class='alert alert-danger' id='duplicateIssueAlert'>
        Member already has this book
    </div>";
}
}
if(isset($_GET['delete_id'])){

    $id = $_GET['delete_id'];

    mysqli_query($conn,
"DELETE FROM fines
WHERE transaction_id='$id'");

mysqli_query($conn,
"DELETE FROM transactions
WHERE transaction_id='$id'");
  
  echo "<script>
window.location='transactions.php?msg=deleted';
</script>";
exit();
}
if(isset($_POST['return_book'])){

    $id = $_POST['transaction_id'];

    $actual_return_date = $_POST['actual_return_date'];
$check_issue=mysqli_query($conn,
"SELECT issue_date
FROM transactions
WHERE transaction_id='$id'");

$data=mysqli_fetch_assoc($check_issue);

$issue_date=$data['issue_date'];

if($actual_return_date < $issue_date){

    echo "
   <div class='alert alert-danger' id='dateErrorAlert'>
    Return date cannot be before issue date
</div>";

}
else{
    mysqli_query($conn,
    "UPDATE transactions
    SET actual_return_date='$actual_return_date'
    WHERE transaction_id='$id'");
mysqli_query($conn,
"UPDATE books

SET available_copies = available_copies + 1

WHERE book_id = (
    SELECT book_id
    FROM transactions
    WHERE transaction_id='$id'
)");
    echo "
    <div class='alert alert-success' id='returnAlert'>
    Book Returned Successfully
</div>";
}
}
if(isset($_GET['scan_return_id'])){

    $book_id = $_GET['scan_return_id'];

    $pending = mysqli_query($conn,

    "SELECT
    t.transaction_id,
    m.name,
    b.title,
    t.issue_date,
    t.return_date

    FROM transactions t

    JOIN members m
    ON t.member_id = m.member_id

    JOIN books b
    ON t.book_id = b.book_id

    WHERE t.book_id='$book_id'
    AND t.actual_return_date IS NULL");

    if(mysqli_num_rows($pending) > 0){

        echo "

        <div class='card-main'>

        <h6>Select Member Returning Book</h6>

        <table class='table table-bordered'>

        <tr>

        <th>Member</th>
        <th>Book</th>
        <th>Issue Date</th>
        <th>Expected Return</th>
        <th>Action</th>

        </tr>";

        while($p=mysqli_fetch_assoc($pending)){

            echo "

            <tr>

            <td>{$p['name']}</td>

            <td>{$p['title']}</td>

            <td>{$p['issue_date']}</td>

            <td>{$p['return_date']}</td>

            <td>

            <a href='transactions.php?final_return_id={$p['transaction_id']}'>

            <button class='btn btn-success'>

            Return

            </button>

            </a>

            </td>

            </tr>";
        }

        echo "</table></div>";
    }

    else{

        echo "

        <div class='alert alert-warning'>

        No active borrowing found for this book

        </div>";
    }
}
if(isset($_GET['final_return_id'])){

    $id = $_GET['final_return_id'];

    $today = date('Y-m-d');

    mysqli_query($conn,

    "UPDATE transactions

    SET actual_return_date='$today'

    WHERE transaction_id='$id'");

    mysqli_query($conn,

    "UPDATE books

    SET available_copies = available_copies + 1

    WHERE book_id = (

        SELECT book_id
        FROM transactions
        WHERE transaction_id='$id'
    )");

    echo "
    <div class='alert alert-success' id='returnAlert'>
    Book Returned Successfully
</div>";
}
    if(isset($_POST['issue_book'])){

       $member_id=$_POST['member_id'];

$book_id=$_POST['book_id'];

$issue_date=$_POST['issue_date'];


$return_date = date(
    'Y-m-d',
    strtotime($issue_date . ' +15 days')
);
$check=mysqli_query($conn,

"SELECT *
FROM transactions

WHERE member_id='$member_id'
AND book_id='$book_id'
AND actual_return_date IS NULL");

if(mysqli_num_rows($check) > 0){

echo "<script>
window.location='transactions.php?msg=issued';
</script>";
exit();

}
else{

        mysqli_query($conn,
        "INSERT INTO transactions
        (member_id,book_id,issue_date,return_date)
        VALUES
        ('$member_id','$book_id','$issue_date','$return_date')");
$getData = mysqli_query($conn,

"SELECT
m.name,
m.email,
b.title

FROM members m

JOIN books b

WHERE m.member_id='$member_id'
AND b.book_id='$book_id'");

$data = mysqli_fetch_assoc($getData);

$name = $data['name'];

$email = $data['email'];

$title = $data['title'];


require 'mail/PHPMailer.php';
require 'mail/SMTP.php';
require 'mail/Exception.php';

$mail = new PHPMailer(true);

$mail->isSMTP();

$mail->Host = 'smtp.gmail.com';

$mail->SMTPAuth = true;

$mail->Username = 'varshagt13@gmail.com';

$mail->Password = 'qadlacbdlehdsgek';

$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

$mail->Port = 587;

$mail->setFrom(
'varshagt13@gmail.com',
'LibraryMS'
);

$mail->addAddress($email);

$mail->Subject = 'Book Issued Successfully';

$mail->Body = "

Hello $name,

Your book has been issued successfully.

Book Name:
$title

Issue Date:
$issue_date

Return Date:
$return_date

Please return the book before the due date.

Library Management System
";

$mail->send();
        mysqli_query($conn,
        "UPDATE books
        SET available_copies=available_copies-1
        WHERE book_id='$book_id'");

       echo "<script>
window.location='transactions.php?msg=issued';
</script>";
exit();
    }
    }
    ?>

    <div class="card-main">

        <h6>Issue Book</h6>
<button
type="button"
onclick="startScanner()"
class="btn btn-primary mb-3">

Open Camera

</button>

<div id="reader"
style="
width:300px;
margin-bottom:20px;
display:none;
">
</div>
<div style="margin-bottom:20px;">

<button type="button"
onclick="issueBookQR()"
class="btn btn-success">

Issue Using QR

</button>

<button type="button"
onclick="returnBookQR()"
class="btn btn-danger ms-2">

Return Using QR

</button>

</div>
        <form method="POST">

            <div class="row g-3">

                <div class="col-md-3">

                    <select name="member_id"
                    class="form-select"
                    required>

                        <option value="">
                            Select Member
                        </option>

                        <?php

                        $members=mysqli_query($conn,
                        "SELECT * FROM members");

                        while($m=mysqli_fetch_assoc($members)){

                            echo "
                            <option value='{$m['member_id']}'>
                                {$m['name']}
                            </option>";
                        }

                        ?>

                    </select>

                </div>

                <div class="col-md-3">
<input type="hidden"
id="scanned_book_id">
                   <select name="book_id"
id="book_select"
class="form-select"
required>

                        <option value="">
                            Select Book
                        </option>

                        <?php

                        $books=mysqli_query($conn,
                        "SELECT * FROM books
                        WHERE available_copies > 0");

                     while($b=mysqli_fetch_assoc($books)){

    echo "
    <option value='{$b['book_id']}'>
        {$b['title']}
    </option>";
}

                        ?>

                    </select>

                </div>

                <div class="col-md-2">

                    <input type="date"
                    name="issue_date"
                    class="form-control"
                    required>

                </div>

                
                <div class="col-md-2">

                    <button type="submit"
                    name="issue_book"
                    class="btn-custom w-100">

                        Issue Book

                    </button>

                </div>

            </div>

        </form>

    </div>

    <div class="card-main">

        <h6>All Transactions</h6>

        <table class="table table-borderless">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Member</th>
                    <th>Book</th>
                    <th>Issue Date</th>
                    <th>Return Date</th>
                    <th>Actual Return</th>

<th>Actions</th>

                </tr>

            </thead>

            <tbody>

            <?php

            $result=mysqli_query($conn,
            "SELECT
            t.transaction_id,
            m.name,
            b.title,
            t.issue_date,
      t.return_date,
t.actual_return_date

            FROM transactions t

            JOIN members m
            ON t.member_id=m.member_id

            JOIN books b
            ON t.book_id=b.book_id");
$count = 1;
            while($row=mysqli_fetch_assoc($result)){

                echo "

                <tr>
<td>".$count++."</td>

                    <td>
                        <b>{$row['name']}</b>
                    </td>

                    <td>{$row['title']}</td>

                    <td>{$row['issue_date']}</td>
<td>{$row['return_date']}</td>
                    
                    <td>{$row['actual_return_date']}</td>
                   
                    


<td>

<div style='display:flex;
align-items:center;
gap:10px;
flex-wrap:wrap;'>

<form method='POST'
style='display:flex;
align-items:center;
gap:5px;
margin:0;'>

<input type='hidden'
name='transaction_id'
value='".$row['transaction_id']."'>


<input type='date'
name='actual_return_date'
class='form-control'
style='width:170px;'
required>


<button type='submit'
name='return_book'
class='btn-custom'>

Return

</button>

</form>

<a href='edit_transaction.php?id=".$row['transaction_id']."'>
<button class='btn-edit'>Edit</button>
</a>

<a href='transactions.php?delete_id=".$row['transaction_id']."'
onclick='return confirm(\"Delete this transaction?\")'>

<button class='btn-delete'>Delete</button>

</a>

</div>

</td>

                </tr>";
            }

            ?>

            </tbody>

        </table>

    </div>

</div>
<script src="https://unpkg.com/html5-qrcode"></script>



<script>

let scannedBookId = "";

let scannerStopped = false;

function onScanSuccess(decodedText){

    if(scannerStopped){
        return;
    }

    scannerStopped = true;

    scannedBookId = decodedText;

    let dropdown=document.getElementById("book_select");

dropdown.value = decodedText.trim();

dropdown.dispatchEvent(new Event('change'));
    alert("QR Code Scanned Successfully");

    html5QrcodeScanner.clear();

    document.getElementById("reader").style.display = "none";

}
let scannerStarted = false;

let html5QrcodeScanner;

function startScanner(){

    if(scannerStarted){
        return;
    }

    document.getElementById("reader").style.display = "block";

    html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        {
            fps: 10,
            qrbox: 250
        }
    );

    html5QrcodeScanner.render(onScanSuccess);

    scannerStarted = true;
}
function issueBookQR(){

    if(scannedBookId == ""){

        alert("Scan QR First");

        return;
    }

    let member =
    document.querySelector("[name='member_id']").value;

    let issueDate =
    document.querySelector("[name='issue_date']").value;

    if(member == ""){

        alert("Please Select Member");

        return;
    }

    if(issueDate == ""){

        alert("Please Select Issue Date");

        return;
    }

    alert("Ready To Issue Book");

}

function returnBookQR(){

    if(scannedBookId == ""){

        alert("Scan QR First");

        return;
    }

    window.location.href =
    "transactions.php?scan_return_id=" + scannedBookId;

}

</script>
<script>

setTimeout(function(){

    let issue=document.getElementById('issueAlert');

    if(issue){
        issue.style.display='none';
    }

    let ret=document.getElementById('returnAlert');

    if(ret){
        ret.style.display='none';
    }
let dateError=document.getElementById('dateErrorAlert');

if(dateError){
    dateError.style.display='none';
}
let delTransaction=document.getElementById('deleteTransactionAlert');

if(delTransaction){
    delTransaction.style.display='none';
}
let duplicateIssue=document.getElementById('duplicateIssueAlert');

if(duplicateIssue){
    duplicateIssue.style.display='none';
}
},3000);

</script>
</body>
</html>