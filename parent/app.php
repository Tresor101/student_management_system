
<?php
session_start();
require_once '../config/db.php';
include 'navbar.php';

$success = $error = '';
$parent_id = null;
$parent_name = '';
$parent_phone = '';
$parent_address = '';
if (isset($_SESSION['user_id'])) {
	$user_id = $_SESSION['user_id'];
	$q = $conn->prepare("SELECT linked_id FROM users WHERE user_id = ? AND role = 'parent'");
	$q->bind_param('i', $user_id);
	$q->execute();
	$q->bind_result($parent_id);
	$q->fetch();
	$q->close();
	if ($parent_id) {
		$q2 = $conn->prepare("SELECT full_name, phone, address FROM parents WHERE parent_id = ?");
		$q2->bind_param('i', $parent_id);
		$q2->execute();
		$q2->bind_result($parent_name, $parent_phone, $parent_address);
		$q2->fetch();
		$q2->close();
	}
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$child_name = trim($_POST['child_name'] ?? '');
	$gender = trim($_POST['gender'] ?? '');
	$dob = trim($_POST['dob'] ?? '');
	$class_grade = trim($_POST['class_grade'] ?? '');
	if ($parent_id && $child_name && $gender && $dob && $class_grade) {
		// Age validation: 3 <= age <= 23
		$dob_date = DateTime::createFromFormat('Y-m-d', $dob);
		$today = new DateTime();
		$age = $dob_date ? $today->diff($dob_date)->y : null;
		if ($age === null || $age < 3 || $age > 23) {
			$error = 'Child must be between 3 and 23 years old as of today.';
		} else {
			$stmt = $conn->prepare("INSERT INTO students (full_name, gender, date_of_birth, parent_id, class_grade) VALUES (?, ?, ?, ?, ?)");
			$stmt->bind_param('sssis', $child_name, $gender, $dob, $parent_id, $class_grade);
			if ($stmt->execute()) {
				$success = 'Application submitted successfully!';
			} else {
				$error = 'Error submitting application.';
			}
			$stmt->close();
		}
	} else {
		$error = 'Please fill in all required fields.';
	}
}
?>
<div class="container py-4 dashboard-bg">
	<div class="row mb-4 align-items-center">
		<div class="col-md-8">
			<h1 class="display-6 mb-1">Apply for New Child</h1>
			<p class="lead text-muted">Fill in your child's details to apply for admission.</p>
		</div>
		<div class="col-md-4 text-end d-none d-md-block">
			<img src="https://img.icons8.com/color/96/school.png" alt="Application Icon" style="height:72px;">
		</div>
	</div>
	<?php if ($success): ?>
		<div class="alert alert-success"> <?= $success ?> </div>
	<?php elseif ($error): ?>
		<div class="alert alert-danger"> <?= $error ?> </div>
	<?php endif; ?>
	<div class="card glass-card p-4 mb-2">
		<form method="post" action="">
			<h5 class="mb-3">Parent Information</h5>
			<div class="row g-3 mb-2">
				<div class="col-md-6">
					<label class="form-label">Parent Name</label>
					<input type="text" class="form-control" value="<?= htmlspecialchars($parent_name) ?>" disabled>
				</div>
				<div class="col-md-6">
					<label class="form-label">Phone</label>
					<input type="text" class="form-control" value="<?= htmlspecialchars($parent_phone) ?>" disabled>
				</div>
			</div>
			<h5 class="mb-3 mt-4">Child Information</h5>
			<div class="row g-3">
				<div class="col-md-6">
					<label for="child_name" class="form-label">Full Name</label>
					<input type="text" class="form-control" id="child_name" name="child_name" required>
				</div>
				<div class="col-md-3">
					<label for="gender" class="form-label">Gender</label>
					<select class="form-select" id="gender" name="gender" required>
						<option value="">Select</option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
				</div>
				<div class="col-md-3">
					<label for="dob" class="form-label">Date of Birth</label>
					<input type="date" class="form-control" id="dob" name="dob" required>
				</div>
				<div class="col-md-6">
					<label for="class_grade" class="form-label">Class/Grade</label>
					<input type="text" class="form-control" id="class_grade" name="class_grade" required>
				</div>
			</div>
			<div class="mt-4 text-end">
				<button type="submit" class="btn btn-primary px-4">Submit Application</button>
			</div>
		</form>
	</div>
</div>
	<?php
	// Show list of applications made by this parent (if any)
	if ($parent_name && $parent_phone) {
		$app_q = $conn->prepare("SELECT child_name, status, created_at FROM applications WHERE parent_name = ? AND phone = ? ORDER BY created_at DESC");
		$app_q->bind_param('ss', $parent_name, $parent_phone);
		$app_q->execute();
		$app_q->bind_result($child_name, $status, $created_at);
		$apps = [];
		while ($app_q->fetch()) {
			$apps[] = [ 'child_name' => $child_name, 'status' => $status, 'created_at' => $created_at ];
		}
		$app_q->close();
		?>
	<div class="card glass-card p-4 mb-4">
		<h5 class="mb-3">Your Applications</h5>
		<div class="table-responsive">
			<table class="table table-bordered align-middle">
				<thead class="table-light">
					<tr>
						<th>Child Name</th>
						<th>Status</th>
						<th>Submitted At</th>
					</tr>
				</thead>
				<tbody>
				<?php if (count($apps) > 0): ?>
					<?php foreach ($apps as $a): ?>
						<tr>
							<td><?= htmlspecialchars($a['child_name']) ?></td>
							<td><?= htmlspecialchars(ucfirst($a['status'])) ?></td>
							<td><?= date('M d, Y H:i', strtotime($a['created_at'])) ?></td>
						</tr>
					<?php endforeach; ?>
				<?php else: ?>
					<tr>
						<td colspan="3" class="text-center text-muted">No applications submitted yet.</td>
					</tr>
				<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
	<?php
	}
	?>
<?php include '../includes/footer.php'; ?>
