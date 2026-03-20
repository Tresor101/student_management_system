<?php
require_once '../config/db.php';
require_once '../includes/auth_check.php';
include '../includes/header.php';
?>
<div class="container mt-4">
    <div class="row mb-4 align-items-center">
        <div class="col-md-8">
            <h1 class="mb-1">Welcome, Principal / Headmaster</h1>
            <p class="lead text-muted">Oversee school operations, approve requests, and communicate with staff and parents.</p>
        </div>
        <div class="col-md-4 text-end d-none d-md-block">
            <img src="https://img.icons8.com/color/96/principal-male.png" alt="Principal Icon" style="height:72px;">
        </div>
    </div>
    <div class="row mb-4 g-3">
        <div class="col-6 col-md-3">
            <div class="card shadow-sm border-0 text-center h-100">
                <div class="card-body">
                    <div class="mb-2"><span style="font-size:2.2rem;">🎓</span></div>
                    <h6 class="card-title">Total Students</h6>
                    <p class="display-6 fw-bold mb-0"><?php echo $student_count ?? 0; ?></p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card shadow-sm border-0 text-center h-100">
                <div class="card-body">
                    <div class="mb-2"><span style="font-size:2.2rem;">👨‍🏫</span></div>
                    <h6 class="card-title">Total Teachers</h6>
                    <p class="display-6 fw-bold mb-0"><?php echo $teacher_count ?? 0; ?></p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card shadow-sm border-0 text-center h-100">
                <div class="card-body">
                    <div class="mb-2"><span style="font-size:2.2rem;">👨‍👩‍👧</span></div>
                    <h6 class="card-title">Total Parents</h6>
                    <p class="display-6 fw-bold mb-0"><?php echo $parent_count ?? 0; ?></p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card shadow-sm border-0 text-center h-100">
                <div class="card-body">
                    <div class="mb-2"><span style="font-size:2.2rem;">🏫</span></div>
                    <h6 class="card-title">Total Classes</h6>
                    <p class="display-6 fw-bold mb-0"><?php echo $class_count ?? 0; ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-primary text-white">Approvals</div>
                <div class="card-body d-flex flex-wrap gap-2">
                    <a href="#" class="btn btn-outline-primary flex-fill">Approve Leave Requests</a>
                    <a href="#" class="btn btn-outline-success flex-fill">Approve Budget Requests</a>
                    <a href="#" class="btn btn-outline-info flex-fill">Approve Announcements</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-info text-white">Communication</div>
                <div class="card-body d-flex flex-wrap gap-2">
                    <a href="#" class="btn btn-outline-primary flex-fill">Message Teachers</a>
                    <a href="#" class="btn btn-outline-success flex-fill">Message Parents</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-dark text-white">Quick Actions</div>
                <div class="card-body d-flex flex-wrap gap-2">
                    <a href="#" class="btn btn-outline-warning flex-fill">View Reports</a>
                    <a href="#" class="btn btn-outline-danger flex-fill">School Calendar</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
