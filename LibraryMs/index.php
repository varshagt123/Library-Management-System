<?php

session_start();

if(!isset($_SESSION['role'])){

    header("Location:login.php");

    exit();
}

if($_SESSION['role'] != 'librarian'){

    header("Location:student_dashboard.php");

    exit();
}

?>
<?php include 'db.php'; 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard | LibraryMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #d8e4f0; color: #1a3a5c; display: flex; min-height: 100vh; }
        .sidebar { width: 250px; background: #2e5b8a; position: fixed; height: 100vh; display: flex; flex-direction: column; z-index: 100; }
        .sidebar-logo { padding: 24px 20px; border-bottom: 1px solid #3a6fa0; }
        .sidebar-logo h4 { color: #fff; font-size: 18px; font-weight: 700; margin: 0; }
        .sidebar-logo span { color: #a0bcd8; font-size: 12px; }
        .nav-label { padding: 20px 20px 8px; color: #7aabcc; font-size: 10px; font-weight: 600; letter-spacing: 1.5px; text-transform: uppercase; }
        .sidebar a { display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: #a0bcd8; text-decoration: none; font-size: 14px; font-weight: 500; transition: all 0.2s; border-left: 3px solid transparent; }
        .sidebar a:hover { background: #3a6fa0; color: #fff; }
        .sidebar a.active { background: #3a6fa0; color: #fff; border-left: 3px solid #63b3ed; }
        .sidebar a i { width: 18px; }
        .sidebar-footer { margin-top: auto; padding: 16px; border-top: 1px solid #3a6fa0; }
        .sidebar-footer a { display: flex; align-items: center; gap: 12px; padding: 10px 16px; color: #fc8181; text-decoration: none; border-radius: 8px; font-size: 14px; transition: all 0.2s; }
        .sidebar-footer a:hover { background: #fc818120; }
        .main { margin-left: 250px; flex: 1; padding: 30px; }
        .topbar { background: #fff; padding: 16px 24px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center; }
        .topbar h5 { font-size: 20px; font-weight: 700; color: #1a3a5c; margin: 0; }
        .stat-card { background: #fff; border-radius: 14px; padding: 22px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); display: flex; align-items: center; gap: 16px; transition: transform 0.2s; border-left: 5px solid transparent; }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,0,0,0.12); }
        .stat-icon { width: 52px; height: 52px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; }
        .stat-card h2 { font-size: 26px; font-weight: 700; color: #1a3a5c; margin: 0; }
        .stat-card p { color: #5a7a9a; font-size: 13px; margin: 2px 0 0; }
        .card-main { background: #fff; border-radius: 14px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); margin-bottom: 20px; }
        .card-main h6 { font-size: 15px; font-weight: 700; color: #1a3a5c; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 2px solid #d8e4f0; }
        .table th { font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.8px; color: #5a7a9a; border-bottom: 2px solid #d8e4f0; padding: 10px 12px; }
        .table td { font-size: 14px; color: #2e5b8a; border-bottom: 1px solid #e8f0f8; padding: 12px; vertical-align: middle; }
        .quick-btn { display: flex; align-items: center; gap: 12px; padding: 13px 16px; border-radius: 10px; text-decoration: none; font-size: 14px; font-weight: 600; margin-bottom: 10px; transition: all 0.2s; }
        .quick-btn:hover { transform: translateX(4px); filter: brightness(0.95); }
        #libraryChart{
    max-height:350px;
}
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="sidebar">
    <div class="sidebar-logo">
        <h4>📚 LibraryMS</h4>
        <span>Management System</span>
    </div>
    <div class="nav-label">Main Menu</div>
    <a href="index.php" class="active"><i class="fas fa-chart-pie"></i> Dashboard</a>
    <a href="books.php"><i class="fas fa-book"></i> Books</a>
    <a href="members.php"><i class="fas fa-users"></i> Members</a>
    <a href="transactions.php"><i class="fas fa-exchange-alt"></i> Transactions</a>
    <a href="fines.php"><i class="fas fa-rupee-sign"></i> Fines</a>
    <div class="sidebar-footer">
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>
<div class="main">
    <div class="topbar">
        
    <div>
    <h5>Dashboard</h5>

    <small style="color:#5a7a9a;">

        Welcome,
        <?php echo $_SESSION['username']; ?> 👋

    </small>
</div>
        <span style="background:#d8e4f0; padding:8px 16px; border-radius:20px; font-size:13px; color:#2e5b8a; font-weight:500;">
            <i class="fas fa-calendar me-2"></i><?php echo date('d M Y'); ?></span>
    </div>

    <?php
    $total_books = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM books"))[0];
    $total_members = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM members"))[0];
    $total_transactions = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM transactions"))[0];
    $available = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(available_copies) FROM books"))[0];
    ?>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card" style="border-left-color:#2e5b8a">
                <div class="stat-icon" style="background:#d8e4f0;">
                    <i class="fas fa-book" style="color:#2e5b8a;"></i>
                </div>
                <div><h2><?php echo $total_books; ?></h2><p>Total Books</p></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="border-left-color:#ec4899">
                <div class="stat-icon" style="background:#fce7f3;">
                    <i class="fas fa-users" style="color:#ec4899;"></i>
                </div>
                <div><h2><?php echo $total_members; ?></h2><p>Total Members</p></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="border-left-color:#3b82f6">
                <div class="stat-icon" style="background:#dbeafe;">
                    <i class="fas fa-exchange-alt" style="color:#3b82f6;"></i>
                </div>
                <div><h2><?php echo $total_transactions; ?></h2><p>Transactions</p></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="border-left-color:#10b981">
                <div class="stat-icon" style="background:#d1fae5;">
                    <i class="fas fa-check-circle" style="color:#10b981;"></i>
                </div>
                <div><h2><?php echo $available; ?></h2><p>Available Books</p></div>
            </div>
        </div>
    </div>
<div class="card-main">

<h6>Library Analytics</h6>

<canvas id="libraryChart" height="100"></canvas>

</div>
    <div class="row g-4">
        <div class="col-md-8">
            <div class="card-main">
                <h6>Recent Transactions</h6>
                <table class="table table-borderless">
                    <thead><tr><th>Member</th><th>Book</th><th>Issue Date</th><th>Return Date</th></tr></thead>
                    <tbody>
                    <?php
                    $recent = mysqli_query($conn, "SELECT m.name, b.title, t.issue_date, t.return_date FROM transactions t JOIN members m ON t.member_id=m.member_id JOIN books b ON t.book_id=b.book_id ORDER BY t.transaction_id DESC LIMIT 5");
                    while($r = mysqli_fetch_assoc($recent))
                        echo "<tr><td><b>{$r['name']}</b></td><td>{$r['title']}</td><td>{$r['issue_date']}</td><td>{$r['return_date']}</td></tr>";
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-main">
                <h6>Quick Actions</h6>
                <a href="books.php" class="quick-btn" style="background:#d8e4f0; color:#2e5b8a;">
                    <i class="fas fa-plus"></i> Add New Book</a>
                <a href="members.php" class="quick-btn" style="background:#d1fae5; color:#10b981;">
                    <i class="fas fa-user-plus"></i> Add New Member</a>
                <a href="transactions.php" class="quick-btn" style="background:#dbeafe; color:#3b82f6;">
                    <i class="fas fa-exchange-alt"></i> Issue a Book</a>
                <a href="fines.php" class="quick-btn" style="background:#ffedd5; color:#f97316;">
                    <i class="fas fa-rupee-sign"></i> View Fines</a>
            </div>
        </div>
    </div>
</div>
<script>

const ctx =
document.getElementById('libraryChart');

new Chart(ctx, {

type: 'bar',

data: {

labels: [

'Books',
'Members',
'Transactions',
'Available Books'

],

datasets: [{

label: 'Library Statistics',

data: [

<?php echo $total_books; ?>,
<?php echo $total_members; ?>,
<?php echo $total_transactions; ?>,
<?php echo $available; ?>

],

backgroundColor: [

'#2e5b8a',
'#ec4899',
'#3b82f6',
'#10b981'

],

borderWidth: 1

}]
},

options: {

responsive: true,
maintainAspectRatio: false,
plugins: {

legend: {

display: true

}

}

}

});

</script>
</body>
</html>