<?php
require_once '../config/db.php';
require_once '../includes/auth_check.php';
include '../includes/header.php';

$success = $error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role = $_POST['role'] ?? '';
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $department = trim($_POST['department'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $employment_date = date('Y-m-d');

    if ($role === 'teacher') {
        $qualification = $department;
        $subject_specialization = '';
        $stmt = $conn->prepare("INSERT INTO teachers (full_name, phone, qualification, subject_specialization, employment_date) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('sssss', $fullname, $phone, $qualification, $subject_specialization, $employment_date);
        if ($stmt->execute()) {
            $success = 'Teacher registered successfully!';
        } else {
            $error = 'Error registering teacher.';
        }
        $stmt->close();
    } elseif ($role === 'staff') {
        $staff_role = $department;
        $stmt = $conn->prepare("INSERT INTO staff (full_name, phone, role, employment_date) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $fullname, $phone, $staff_role, $employment_date);
        if ($stmt->execute()) {
            $success = 'Staff registered successfully!';
        } else {
            $error = 'Error registering staff.';
        }
        $stmt->close();
    } else {
        $error = 'Please select a valid role.';
    }
}
?>
<div class="container mt-4">
    <div class="row mb-4 align-items-center">
        <div class="col-md-8">
            <h1 class="mb-1">Register Staff & Teacher</h1>
            <p class="lead text-muted">Add new staff or teacher to the school system.</p>
        </div>
        <div class="col-md-4 text-end d-none d-md-block">
            <img src="https://img.icons8.com/color/96/teacher.png" alt="Staff/Teacher Icon" style="height:72px;">
        </div>
    </div>
    <?php if ($success): ?>
        <div class="alert alert-success"> <?= $success ?> </div>
    <?php elseif ($error): ?>
        <div class="alert alert-danger"> <?= $error ?> </div>
    <?php endif; ?>
    <div class="card glass-card p-4 mb-4">
        <form method="post" action="">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role" name="role" required>
                        <option value="">Select Role</option>
                        <option value="teacher">Teacher</option>
                        <option value="staff">Staff</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="fullname" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" required>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone">
                </div>
                <div class="col-md-6">
                    <label for="department" class="form-label">Department / Qualification / Role</label>
                    <input type="text" class="form-control" id="department" name="department">
                </div>
                <div class="col-md-6">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
            </div>
            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-primary px-4">Register</button>
            </div>
        </form>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
