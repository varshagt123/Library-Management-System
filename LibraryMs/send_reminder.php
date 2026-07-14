<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mail/PHPMailer.php';
require 'mail/SMTP.php';
require 'mail/Exception.php';

include 'db.php';

$mail = new PHPMailer(true);

try {

    $mail->isSMTP();

    $mail->Host = 'smtp.gmail.com';

    $mail->SMTPAuth = true;

    $mail->Username = 'abc123@gmail.com';

    $mail->Password = 'qadlacbdlehdsgek';

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    $mail->Port = 587;

    $today = date('Y-m-d');

    $result = mysqli_query($conn,

    "SELECT
    t.transaction_id,
    m.name,
    m.email,
    b.title,
    t.return_date

    FROM transactions t

    JOIN members m
    ON t.member_id = m.member_id

    JOIN books b
    ON t.book_id = b.book_id

    WHERE t.return_date = DATE_ADD('$today', INTERVAL 2 DAY)

    AND t.reminder_sent = 0

    AND t.actual_return_date IS NULL"

    );

    while($row = mysqli_fetch_assoc($result)){

        $mail->setFrom(
        'abc123@gmail.com',
        'LibraryMS'
        );

        $mail->addAddress($row['email']);

        $mail->Subject = 'Book Return Reminder';

        $mail->Body = "

Hello {$row['name']},

Your borrowed book '{$row['title']}'
should be returned soon.

Return Date:
{$row['return_date']}

Please return it on time.

Library Management System
";

        $mail->send();

        mysqli_query($conn,

        "UPDATE transactions
        SET reminder_sent = 1
        WHERE transaction_id='{$row['transaction_id']}'");

        echo "Mail sent to: " . $row['email'] . "<br>";

        $mail->clearAddresses();

    }

}

catch (Exception $e){

    error_log($mail->ErrorInfo);

}

?>
