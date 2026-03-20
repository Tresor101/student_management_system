<?php
/*session_start();

// If already logged in → redirect by role
if (isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'admin') {
        header("Location: admin/dashboard.php");
        exit;
    }

    if ($_SESSION['role'] == 'teacher') {
        header("Location: teacher/dashboard.php");
        exit;
    }

    if ($_SESSION['role'] == 'parent') {
        header("Location: parent/dashboard.php");
        exit;
    }
}*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>School Management System</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;400&display=swap" rel="stylesheet">
    <style>
        /* Animated Floating Shapes */
        .bg-shapes {
            position: fixed;
            top: 0; left: 0; width: 100vw; height: 100vh;
            pointer-events: none;
            z-index: 0;
        }
        .bg-shape {
            position: absolute;
            opacity: 0.18;
            filter: blur(2px);
        }
        /* Circle */
        .bg-shape.shape1 {
            width: 120px; height: 120px;
            background: #6a11cb;
            border-radius: 50%;
            left: 10vw; top: 15vh;
            animation: floatShape1 18s linear infinite;
            animation-delay: 0s;
        }
        /* Square */
        .bg-shape.shape2 {
            width: 90px; height: 90px;
            background: #ff9966;
            border-radius: 18px;
            left: 70vw; top: 10vh;
            animation: floatShape2 22s linear infinite;
            animation-delay: 4s;
        }
        /* Triangle */
        .bg-shape.shape3 {
            width: 0; height: 0;
            border-left: 40px solid transparent;
            border-right: 40px solid transparent;
            border-bottom: 70px solid #fdcbf1;
            background: none;
            left: 20vw; top: 70vh;
            animation: floatShape3 20s linear infinite;
            animation-delay: 8s;
            filter: blur(0.5px);
        }
        /* Star */
        .bg-shape.shape4 {
            width: 100px; height: 100px;
            background: none;
            left: 80vw; top: 60vh;
            animation: floatShape4 24s linear infinite;
            animation-delay: 12s;
        }
        .bg-shape.shape4::before {
            content: '';
            position: absolute;
            left: 0; top: 0;
            width: 100px; height: 100px;
            background: none;
            clip-path: polygon(
                50% 0%,
                61% 35%,
                98% 35%,
                68% 57%,
                79% 91%,
                50% 70%,
                21% 91%,
                32% 57%,
                2% 35%,
                39% 35%
            );
            background: #2575fc;
            z-index: 1;
        }
        /* Diamond */
        .bg-shape.shape5 {
            width: 60px; height: 60px;
            background: #fbc2eb;
            left: 50vw; top: 40vh;
            transform: rotate(45deg);
            animation: floatShape5 19s linear infinite;
            animation-delay: 6s;
        }
        @keyframes floatShape1 {
            0% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(40px, -30px) scale(1.1); }
            50% { transform: translate(0, -60px) scale(1.15); }
            75% { transform: translate(-40px, -30px) scale(1.1); }
            100% { transform: translate(0, 0) scale(1); }
        }
        @keyframes floatShape2 {
            0% { transform: translate(0, 0) scale(1); }
            20% { transform: translate(-30px, 40px) scale(1.08); }
            50% { transform: translate(-60px, 0) scale(1.13); }
            80% { transform: translate(-30px, -40px) scale(1.08); }
            100% { transform: translate(0, 0) scale(1); }
        }
        @keyframes floatShape3 {
            0% { transform: translate(0, 0) scale(1); }
            30% { transform: translate(30px, -20px) scale(1.07); }
            60% { transform: translate(0, -40px) scale(1.12); }
            90% { transform: translate(-30px, -20px) scale(1.07); }
            100% { transform: translate(0, 0) scale(1); }
        }
        @keyframes floatShape4 {
            0% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(-40px, 30px) scale(1.1); }
            50% { transform: translate(0, 60px) scale(1.15); }
            75% { transform: translate(40px, 30px) scale(1.1); }
            100% { transform: translate(0, 0) scale(1); }
        }
        @keyframes floatShape5 {
            0% { transform: translate(0, 0) scale(1); }
            40% { transform: translate(20px, 30px) scale(1.09); }
            70% { transform: translate(-20px, 30px) scale(1.09); }
            100% { transform: translate(0, 0) scale(1); }
        }
        html, body {
            height: 100%;
        }
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Montserrat', Arial, sans-serif;
            background: linear-gradient(270deg, #ffecd2, #fcb69f, #a1c4fd, #c2e9fb, #fbc2eb, #fdcbf1, #a1c4fd, #fcb69f);
            background-size: 1600% 1600%;
            animation: bgGradientMove 18s ease-in-out infinite;
        }
        @keyframes bgGradientMove {
            0% {background-position:0% 50%}
            25% {background-position:50% 100%}
            50% {background-position:100% 50%}
            75% {background-position:50% 0%}
            100% {background-position:0% 50%}
        }
        .content-wrapper {
            flex: 1 0 auto;
        }
        /* Fancy Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: #fff;
            border-radius: 1rem;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            padding: 3rem 1rem 2.5rem 1rem;
            margin-top: 3rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }
        .hero-section h1 {
            font-size: 2.8rem;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .hero-section p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
        }
        /* Animated Button */
        .btn-fancy {
            background: linear-gradient(90deg, #ff9966 0%, #ff5e62 100%);
            color: #fff;
            border: none;
            font-size: 1.2rem;
            font-weight: 700;
            padding: 0.75rem 2.5rem;
            border-radius: 2rem;
            box-shadow: 0 4px 16px rgba(255, 94, 98, 0.15);
            transition: transform 0.2s, box-shadow 0.2s, background 0.3s;
            position: relative;
            overflow: hidden;
        }
        .btn-fancy:hover, .btn-fancy:focus {
            transform: translateY(-3px) scale(1.04);
            box-shadow: 0 8px 32px rgba(255, 94, 98, 0.25);
            background: linear-gradient(90deg, #ff5e62 0%, #ff9966 100%);
            color: #fff;
        }
        /* Card Hover Effect */
        .card {
            border: none;
            border-radius: 1rem;
            transition: transform 0.18s, box-shadow 0.18s;
        }
        .card:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
        }
        /* Modern Glassmorphic Role Buttons */
        .role-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 110px;
            height: 110px;
            background: rgba(255,255,255,0.18);
            border-radius: 50%;
            box-shadow: 0 4px 24px 0 rgba(31, 38, 135, 0.10), 0 1.5px 8px 0 rgba(255,255,255,0.18) inset;
            border: 1.5px solid rgba(255,255,255,0.35);
            backdrop-filter: blur(6px);
            color: #333;
            font-size: 1.08rem;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            margin: 0.7rem;
            transition: transform 0.18s, box-shadow 0.18s, border 0.18s, color 0.18s;
            position: relative;
            overflow: hidden;
        }
        .role-btn:hover, .role-btn:focus {
            transform: translateY(-8px) scale(1.07);
            box-shadow: 0 8px 32px 0 #6a11cb44, 0 0 16px 2px #ff996655;
            border: 2.5px solid #ff9966;
            color: #6a11cb;
        }
        .role-icon {
            font-size: 2.3rem;
            display: block;
            margin-bottom: 0.3rem;
            filter: drop-shadow(0 2px 6px #fff6);
        }
        /* Navbar and Footer */
        .navbar {
            box-shadow: 0 2px 8px rgba(106, 17, 203, 0.08);
        }
        footer {
            flex-shrink: 0;
            box-shadow: 0 -2px 12px rgba(31, 38, 135, 0.08);
            background: linear-gradient(90deg, #232526 0%, #414345 100%);
        }
    </style>
</head>

<body class="bg-light">
    <div class="bg-shapes">
        <div class="bg-shape shape1"></div>
        <div class="bg-shape shape2"></div>
        <div class="bg-shape shape3"></div>
        <div class="bg-shape shape4"></div>
        <div class="bg-shape shape5"></div>
    </div>

<!-- NAVBAR -->
<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">🏫 School System</a>
        <a href="auth/login.php" class="btn btn-light btn-sm">Login</a>
    </div>
</nav>


<div class="content-wrapper">
    <!-- HERO SECTION -->
    <div class="container hero-section text-center">
        <h1 class="display-5 fw-bold">Welcome to School Management System</h1>
        <p class="lead mt-3">
            Manage students, parents, teachers, attendance, grades and school fees in one place.
        </p>
        <a href="auth/login.php" class="btn btn-fancy btn-lg mt-3">
            Get Started
        </a>
    </div>

    <!-- USER ROLE BUTTONS -->
    <div class="container mt-5">
        <div class="row text-center justify-content-center g-3">
            <div class="col-6 col-sm-4 col-md-2 mb-3">
                <!--<a href="auth/login.php?role=admin" class="role-btn">-->
                    <a href="admin/dashboard.php" class="role-btn">
                    <span class="role-icon">🧑‍💼</span>
                    <span>Admin</span>
                </a>
            </div>
            <div class="col-6 col-sm-4 col-md-2 mb-3">
                <a href="auth/login.php?role=staff" class="role-btn">
                    <span class="role-icon">👩‍💻</span>
                    <span>Staff</span>
                </a>
            </div>
            <div class="col-6 col-sm-4 col-md-2 mb-3">
                <a href="auth/login.php?role=teacher" class="role-btn">
                    <span class="role-icon">👨‍🏫</span>
                    <span>Teacher</span>
                </a>
            </div>
            <div class="col-6 col-sm-4 col-md-2 mb-3">
                <a href="auth/login.php?role=parent" class="role-btn">
                    <!--<a href="parent/dashboard.php" class="role-btn">-->
                    <span class="role-icon">👨‍👩‍👧</span>
                    <span>Parent</span>
                </a>
            </div>
            <div class="col-6 col-sm-4 col-md-2 mb-3">
                <a href="auth/login.php?role=student" class="role-btn">
                    <span class="role-icon">🎓</span>
                    <span>Student</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER -->
<footer class="text-center mt-5 p-3 bg-dark text-white">
    © <?= date("Y") ?> School Management System
</footer>

</body>
</html>