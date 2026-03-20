<?php
require_once '../config/db.php';
require_once '../includes/auth_check.php';
include '../includes/header.php';

$success = $error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $email = trim($_POST['email'] ?? ''); // Not in DB, but kept for possible future use

    if ($fullname && $username && $password) {
        // Insert into parents table
        $stmt = $conn->prepare("INSERT INTO parents (full_name, phone) VALUES (?, ?)");
        $stmt->bind_param('ss', $fullname, $phone);
        if ($stmt->execute()) {
            $parent_id = $conn->insert_id;
            // Insert into users table
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $role = 'parent';
            $stmt2 = $conn->prepare("INSERT INTO users (username, password_hash, role, linked_id) VALUES (?, ?, ?, ?)");
            $stmt2->bind_param('sssi', $username, $password_hash, $role, $parent_id);
            if ($stmt2->execute()) {
                $success = 'Parent registered successfully!';
            } else {
                $error = 'Parent added, but user account creation failed.';
            }
            $stmt2->close();
        } else {
            $error = 'Error registering parent.';
        }
        $stmt->close();
    } else {
        $error = 'Please fill in all required fields.';
    }
}
?>
<div class="container mt-4">
    <div class="row mb-4 align-items-center">
        <div class="col-md-8">
            <h1 class="mb-1">Register Parent</h1>
            <p class="lead text-muted">Add a new parent to the school system.</p>
        </div>
        <div class="col-md-4 text-end d-none d-md-block">
            <img src="https://img.icons8.com/color/96/family.png" alt="Parent Icon" style="height:72px;">
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
                    <label for="fullname" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" required>
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone">
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
