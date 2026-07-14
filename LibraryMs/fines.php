<?php

include 'db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mail/PHPMailer.php';
require 'mail/SMTP.php';
require 'mail/Exception.php';

$today = date('Y-m-d');

$overdue = mysqli_query($conn,"
SELECT
m.name,
m.email,
b.title,
t.return_date
FROM transactions t
JOIN members m
ON t.member_id=m.member_id
JOIN books b
ON t.book_id=b.book_id
WHERE t.actual_return_date IS NULL
AND t.return_date < '$today'
");

while($row=mysqli_fetch_assoc($overdue)){

    $mail = new PHPMailer(true);

    try{

        $mail->isSMTP();
        $mail->Host='smtp.gmail.com';
        $mail->SMTPAuth=true;
        $mail->Username='abc123@gmail.com';
        $mail->Password='qadlacbdlehdsgek';
        $mail->SMTPSecure=PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port=587;

        $mail->setFrom('abc123@gmail.com','LibraryMS');

        $mail->addAddress($row['email']);

        $mail->Subject='Library Fine Reminder';

        $mail->Body="
Hello {$row['name']},

Your borrowed book is overdue.

Book Name:
{$row['title']}

Due Date:
{$row['return_date']}

Please return the book immediately and pay the applicable fine.

Library Management System
";

        $mail->send();

    }catch(Exception $e){}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Fines | LibraryMS</title>

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
            margin:0;
            font-size:18px;
            font-weight:700;
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
            transition:0.2s;
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
            margin:0;
            font-size:20px;
            font-weight:700;
        }

        .card-main{
            background:#fff;
            border-radius:14px;
            padding:24px;
            box-shadow:0 2px 8px rgba(0,0,0,0.08);
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

        .fine{
            color:#ef4444;
            font-weight:700;
        }

        .no-fine{
            color:#10b981;
            font-weight:600;
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

    <a href="transactions.php">
        <i class="fas fa-exchange-alt"></i> Transactions
    </a>

    <a href="fines.php" class="active">
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
            <h5>Fines</h5>
            <small style="color:#5a7a9a;">
                Fine rate: ₹5 per day after return date
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

    <div class="card-main">

        <h6>Fine Calculation</h6>

        <table class="table table-borderless">

            <thead>
                <tr>
                    <th>Member</th>
                    <th>Book</th>
                    <th>Return Date</th>
                    <th>Days Late</th>
                    <th>Fine Amount</th>
                </tr>
            </thead>

            <tbody>

            <?php

           


            $result = mysqli_query($conn,"
    SELECT 
           t.transaction_id,
           m.name,
           b.title,
           t.return_date,
            t.actual_return_date
    FROM transactions t
    JOIN members m
    ON t.member_id = m.member_id
    JOIN books b
    ON t.book_id = b.book_id
");

            while($row = mysqli_fetch_assoc($result)) {

                $return_date = $row['return_date'];

                $days_late = 0;
                $fine = 0;

               $today = date('Y-m-d');

if($row['actual_return_date'] == NULL){

    if(strtotime($today) > strtotime($return_date)){

        $diff = date_diff(
            date_create($return_date),
            date_create($today)
        );

        $days_late = $diff->days;
        $fine = $days_late * 5;
    }

}
else{

    if(strtotime($row['actual_return_date']) > strtotime($return_date)){

        $diff = date_diff(
            date_create($return_date),
            date_create($row['actual_return_date'])
        );

        $days_late = $diff->days;
        $fine = $days_late * 5;
    }
}

$transaction_id = $row['transaction_id'];

if($fine > 0){

    mysqli_query($conn,"
    INSERT INTO fines
    (transaction_id,fine_amount,days_late)
    SELECT
    '$transaction_id','$fine','$days_late'
    WHERE NOT EXISTS (
        SELECT *
        FROM fines
        WHERE transaction_id='$transaction_id'
    )
    ");
}

                echo "<tr>

                    <td><b>{$row['name']}</b></td>

                    <td>{$row['title']}</td>

                    <td>{$row['return_date']}</td>

                    <td>{$days_late} days</td>

                    <td>";

                    if($fine > 0){

                        echo "<span class='fine'>₹{$fine}</span>";

                    } else {

                        echo "<span class='no-fine'>No Fine</span>";
                    }

                echo "</td>

                </tr>";
            }

            ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>
