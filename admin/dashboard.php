<?php
require_once '../config/db.php';
require_once '../includes/auth_check.php';
include '../includes/header.php';

// Fetch counts for overview
$student_count = $teacher_count = $parent_count = $class_count = 0;

// Students
$result = mysqli_query($conn, "SELECT COUNT(*) as total FROM students");
if ($row = mysqli_fetch_assoc($result)) {
	$student_count = $row['total'];
}

// Teachers
$result = mysqli_query($conn, "SELECT COUNT(*) as total FROM teachers");
if ($row = mysqli_fetch_assoc($result)) {
	$teacher_count = $row['total'];
}

// Parents
$result = mysqli_query($conn, "SELECT COUNT(*) as total FROM parents");
if ($row = mysqli_fetch_assoc($result)) {
	$parent_count = $row['total'];
}

// Classes
$result = mysqli_query($conn, "SELECT COUNT(*) as total FROM classes");
if ($row = mysqli_fetch_assoc($result)) {
	$class_count = $row['total'];
}

?>
<div class="container mt-4">
    <div class="row mb-4 align-items-center">
        <div class="col-md-8">
            <h1 class="mb-1">Welcome, Admin</h1>
            <p class="lead text-muted">Manage your school efficiently with real-time stats, quick actions, and communication tools.</p>
        </div>
        <div class="col-md-4 text-end d-none d-md-block">
            <img src="https://img.icons8.com/color/96/administrator-male.png" alt="Admin Icon" style="height:72px;">
        </div>
    </div>
    <div class="row mb-4 g-3">
        <div class="col-6 col-md-3">
            <div class="card glass-card text-center h-100">
                <div class="card-body">
                    <div class="mb-2"><span style="font-size:2.2rem;">🎓</span></div>
                    <h6 class="card-title">Total Students</h6>
                    <p class="display-6 fw-bold mb-0"><?php echo $student_count; ?></p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card glass-card text-center h-100">
                <div class="card-body">
                    <div class="mb-2"><span style="font-size:2.2rem;">👨‍🏫</span></div>
                    <h6 class="card-title">Total Teachers</h6>
                    <p class="display-6 fw-bold mb-0"><?php echo $teacher_count; ?></p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card glass-card text-center h-100">
                <div class="card-body">
                    <div class="mb-2"><span style="font-size:2.2rem;">👨‍👩‍👧</span></div>
                    <h6 class="card-title">Total Parents</h6>
                    <p class="display-6 fw-bold mb-0"><?php echo $parent_count; ?></p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card glass-card text-center h-100">
                <div class="card-body">
                    <div class="mb-2"><span style="font-size:2.2rem;">🏫</span></div>
                    <h6 class="card-title">Total Classes</h6>
                    <p class="display-6 fw-bold mb-0"><?php echo $class_count; ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card glass-card h-100 border-0" style="overflow:hidden;">
                <div class="card-header" style="background:linear-gradient(90deg,#232526 0%,#414345 100%);color:#fff;">
                    <span style="font-size:1.3rem;vertical-align:middle;">🛠️</span> Management
                </div>
                <div class="card-body px-4 py-4">
                    <div class="list-group list-group-flush management-list">
                        <a href="students.php" class="list-group-item list-group-item-action d-flex align-items-center gap-3 border-0 rounded mb-2" style="background:rgba(40,40,40,0.7);color:#fff;">
                            <span style="font-size:1.5rem;">🎓</span> <span class="fw-semibold">Add/Edit Students</span>
                        </a>
                        <a href="staffTeaReg.php" class="list-group-item list-group-item-action d-flex align-items-center gap-3 border-0 rounded mb-2" style="background:rgba(40,40,40,0.7);color:#fff;">
                            <span style="font-size:1.5rem;">👨‍🏫</span> <span class="fw-semibold">Add/Edit Teachers and staffs</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center gap-3 border-0 rounded mb-2" style="background:rgba(40,40,40,0.7);color:#fff;">
                            <span style="font-size:1.5rem;">📚</span> <span class="fw-semibold">Assign Students to Classes</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center gap-3 border-0 rounded" style="background:rgba(40,40,40,0.7);color:#fff;">
                            <span style="font-size:1.5rem;">🧑‍💼</span> <span class="fw-semibold">Manage Staff</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card glass-card h-100">
                <div class="card-header bg-success text-white">Finance Overview</div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <h6>Total Fees Collected</h6>
                            <p class="lead">$0.00 <span class="text-muted">USD</span></p>
                            <p class="lead">0 <span class="text-muted">CDF</span></p>
                        </div>
                        <div class="col-6">
                            <h6>Pending Payments</h6>
                            <p class="lead">$0.00 <span class="text-muted">USD</span></p>
                            <p class="lead">0 <span class="text-muted">CDF</span></p>
                        </div>
                    </div>
                    <div class="text-center mt-2">
                        <a href="#" class="btn btn-outline-secondary btn-sm">View Payment History</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card glass-card h-100">
                <div class="card-header bg-info text-white">Communication</div>
                <div class="card-body d-flex flex-wrap gap-2">
                    <a href="#" class="btn btn-outline-primary flex-fill">Send Broadcast to Parents</a>
                    <a href="#" class="btn btn-outline-success flex-fill">Send Broadcast to Teachers</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card glass-card h-100">
                <div class="card-header bg-dark text-white">System Control</div>
                <div class="card-body d-flex flex-wrap gap-2">
                    <a href="#" class="btn btn-outline-warning flex-fill">Create User Accounts</a>
                    <a href="#" class="btn btn-outline-danger flex-fill">Reset Passwords</a>
                    <a href="#" class="btn btn-outline-secondary flex-fill">Lock/Unlock Accounts</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
