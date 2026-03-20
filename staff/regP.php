<?php

session_start();
require_once '../config/db.php';
require_once '../includes/auth_check.php';
include '../includes/header.php';

// Handle success message from redirect
$success = isset($_SESSION['success']) ? $_SESSION['success'] : '';
unset($_SESSION['success']);
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $email = trim($_POST['email'] ?? ''); // Optional: for contact only, not used as username
    $password = $_POST['password'] ?? '';
    $children = trim($_POST['children'] ?? ''); // Optional: comma-separated child names or IDs

    if ($fullname && $password) {
        // Insert into parents table (no email column)
        $stmt = $conn->prepare("INSERT INTO parents (full_name, phone, address) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $fullname, $phone, $address);
        if ($stmt->execute()) {
            $parent_id = $conn->insert_id;
            // Generate username as PXXXX
            $username = 'P' . str_pad($parent_id, 4, '0', STR_PAD_LEFT);
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $role = 'parent';
            $stmt2 = $conn->prepare("INSERT INTO users (username, password_hash, role, linked_id) VALUES (?, ?, ?, ?)");
            $stmt2->bind_param('sssi', $username, $password_hash, $role, $parent_id);
            if ($stmt2->execute()) {
                // Set success message in session and redirect (PRG pattern)
                $_SESSION['success'] = 'Parent registered successfully! Username: <strong>' . $username . '</strong>';
                header('Location: ' . $_SERVER['PHP_SELF']);
                exit();
            } else {
                $error = 'Parent added, but failed to create user account.';
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
                <!-- Email field is optional, not used for login -->
                <div class="col-md-6">
                    <label for="email" class="form-label">Email (optional)</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="col-md-6">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address">
                </div>
                <div class="col-md-6">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                <div class="col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="col-md-12">
                    <label for="children" class="form-label">Children (optional)</label>
                    <input type="text" class="form-control" id="children" name="children" placeholder="Comma-separated names or IDs">
                </div>
            </div>
            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-primary px-4">Register</button>
            </div>
        </form>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
