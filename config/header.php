<?php
// Header include
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>School Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;400&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', Arial, sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #a1c4fd 50%, #c2e9fb 100%);
            background-attachment: fixed;
        }
        .dashboard-bg {
            min-height: 100vh;
            padding-bottom: 2rem;
        }
        .glass-card {
            background: rgba(255,255,255,0.75);
            border-radius: 1.2rem;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
            backdrop-filter: blur(8px);
            border: 1.5px solid rgba(255,255,255,0.35);
            transition: transform 0.18s, box-shadow 0.18s;
        }
        .glass-card:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 16px 48px 0 rgba(31, 38, 135, 0.22);
        }
        .card-header {
            border-radius: 1.2rem 1.2rem 0 0;
            font-weight: 700;
            font-size: 1.15rem;
            background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
            color: #fff;
        }
        .btn {
            font-weight: 600;
            border-radius: 2rem;
            transition: box-shadow 0.18s, transform 0.18s;
        }
        .btn:focus, .btn:hover {
            box-shadow: 0 4px 16px 0 #6a11cb33;
            transform: translateY(-2px) scale(1.04);
        }
        .display-6 {
            font-size: 2.2rem;
        }
        .lead {
            font-size: 1.13rem;
        }
        .navbar {
            box-shadow: 0 2px 8px rgba(106, 17, 203, 0.08);
            background: linear-gradient(90deg, #232526 0%, #414345 100%);
        }
        footer {
            flex-shrink: 0;
            box-shadow: 0 -2px 12px rgba(31, 38, 135, 0.08);
            background: linear-gradient(90deg, #232526 0%, #414345 100%);
            color: #fff;
        }
        /* Management card list-group-item hover effect */
        .management-list .list-group-item {
            transition: background 0.18s, box-shadow 0.18s, color 0.18s;
        }
        .management-list .list-group-item:hover, .management-list .list-group-item:focus {
            background: rgba(80,80,80,0.85) !important;
            color: #ffd700 !important;
            box-shadow: 0 4px 16px 0 #23252655;
        }
    </style>
</head>
<body class="dashboard-bg">
<nav class="navbar navbar-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="../index.php">🏫 School System</a>
        <a href="../auth/logout.php" class="btn btn-light btn-sm">Logout</a>
    </div>
</nav>
