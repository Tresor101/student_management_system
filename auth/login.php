<?php
session_start();
require_once '../config/db.php';
include '../includes/header.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$username = trim($_POST['username'] ?? '');
	$password = $_POST['password'] ?? '';
	if ($username && $password) {
		$stmt = $conn->prepare("SELECT user_id, password_hash, role FROM users WHERE username = ? AND is_active = 1");
		$stmt->bind_param('s', $username);
		$stmt->execute();
		$stmt->store_result();
		if ($stmt->num_rows === 1) {
			$stmt->bind_result($user_id, $password_hash, $role);
			$stmt->fetch();
			if (password_verify($password, $password_hash)) {
				$_SESSION['user_id'] = $user_id;
				$_SESSION['role'] = $role;
				// Redirect by role
				if ($role === 'parent') {
					header('Location: ../parent/dashboard.php');
				} elseif ($role === 'teacher') {
					header('Location: ../teacher/dashboard.php');
				} elseif ($role === 'staff' || $role === 'admin') {
					header('Location: ../admin/dashboard.php');
				} else {
					header('Location: ../index.php');
				}
				exit();
			} else {
				$error = 'Invalid username or password.';
			}
		} else {
			$error = 'Invalid username or password.';
		}
		$stmt->close();
	} else {
		$error = 'Please enter both username and password.';
	}
}
?>
<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
	<div class="col-md-6 col-lg-5">
		<div class="card glass-card p-4">
			<h2 class="mb-3 text-center">Sign In</h2>
			<?php if ($error): ?>
				<div class="alert alert-danger"> <?= $error ?> </div>
			<?php endif; ?>
			<form method="post" action="">
				<div class="mb-3">
					<label for="username" class="form-label">Username</label>
					<input type="text" class="form-control" id="username" name="username" required autofocus>
				</div>
				<div class="mb-3">
					<label for="password" class="form-label">Password</label>
					<input type="password" class="form-control" id="password" name="password" required>
				</div>
				<div class="d-grid mt-4">
					<button type="submit" class="btn btn-primary btn-lg">Login</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php include '../includes/footer.php'; ?>
