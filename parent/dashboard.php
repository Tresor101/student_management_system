<?php
session_start();
require_once '../config/db.php';
require_once '../includes/auth_check.php';
include 'navbar.php';

// Get logged-in parent info
$user_id = $_SESSION['user_id'] ?? null;
$parent_id = null;
$parent = null;
if ($user_id) {
	$user_q = $conn->prepare("SELECT linked_id FROM users WHERE user_id = ? AND role = 'parent'");
	$user_q->bind_param('i', $user_id);
	$user_q->execute();
	$user_q->bind_result($parent_id);
	$user_q->fetch();
	$user_q->close();
	if ($parent_id) {
		$parent_q = $conn->prepare("SELECT full_name, phone, address FROM parents WHERE parent_id = ?");
		$parent_q->bind_param('i', $parent_id);
		$parent_q->execute();
		$parent_q->bind_result($pname, $pphone, $paddress);
		$parent_q->fetch();
		$parent = [ 'full_name' => $pname, 'phone' => $pphone, 'address' => $paddress ];
		$parent_q->close();
	}
}

// Get children
$children = [];
if ($parent_id) {
	$child_q = $conn->prepare("SELECT student_id, full_name, gender, date_of_birth, class_grade FROM students WHERE parent_id = ?");
	$child_q->bind_param('i', $parent_id);
	$child_q->execute();
	$child_q->bind_result($sid, $sname, $sgender, $sdob, $sclass);
	while ($child_q->fetch()) {
		$children[] = [
			'student_id' => $sid,
			'full_name' => $sname,
			'gender' => $sgender,
			'dob' => $sdob,
			'class' => $sclass
		];
	}
	$child_q->close();
}

// Get announcements (example: last 5)
$announcements = [];
$ann_q = $conn->query("SELECT 'Welcome to the Parent Dashboard!' AS message, NOW() AS date UNION SELECT 'Term 2 starts next week.', NOW() AS date LIMIT 2");
while ($row = $ann_q->fetch_assoc()) {
	$announcements[] = $row;
}

?>
<div class="container dashboard-bg py-4">
	<div class="row mb-4 align-items-center">
		<div class="col-md-8">
			<h1 class="display-6 mb-1">Welcome, <?= htmlspecialchars($parent['full_name'] ?? 'Parent') ?></h1>
			<p class="lead text-muted">Here is your dashboard overview.</p>
		</div>
		<div class="col-md-4 text-end d-none d-md-block">
			<img src="https://img.icons8.com/color/96/family.png" alt="Parent Icon" style="height:72px;">
		</div>
	</div>

	<div class="row g-4 mb-4">
		<div class="col-lg-4">
			<div class="card glass-card h-100">
				<div class="card-header">Parent Info</div>
				<div class="card-body">
					<p><strong>Name:</strong> <?= htmlspecialchars($parent['full_name'] ?? '-') ?></p>
					<p><strong>Phone:</strong> <?= htmlspecialchars($parent['phone'] ?? '-') ?></p>
					<p><strong>Address:</strong> <?= htmlspecialchars($parent['address'] ?? '-') ?></p>
				</div>
			</div>
		</div>
		<div class="col-lg-8">
			<div class="card glass-card h-100">
				<div class="card-header">Announcements</div>
				<div class="card-body">
					<ul class="mb-0">
						<?php foreach ($announcements as $a): ?>
							<li><?= htmlspecialchars($a['message']) ?> <span class="text-muted small ms-2"><?= date('M d, Y', strtotime($a['date'])) ?></span></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="row g-4">
		<div class="col-12">
			<div class="card glass-card">
				<div class="card-header">Your Children</div>
				<div class="card-body">
					<?php if (count($children) === 0): ?>
						<p class="text-muted">No children found.</p>
					<?php else: ?>
						<div class="table-responsive">
						<table class="table table-bordered align-middle">
							<thead class="table-light">
								<tr>
									<th>Name</th>
									<th>Gender</th>
									<th>Date of Birth</th>
									<th>Class</th>
									<th>Attendance</th>
									<th>Grades</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach ($children as $child): ?>
								<tr>
									<td><?= htmlspecialchars($child['full_name']) ?></td>
									<td><?= htmlspecialchars($child['gender']) ?></td>
									<td><?= htmlspecialchars($child['dob']) ?></td>
									<td><?= htmlspecialchars($child['class']) ?></td>
									<td>
										<a href="attendance.php?student_id=<?= $child['student_id'] ?>" class="btn btn-outline-primary btn-sm">View</a>
									</td>
									<td>
										<a href="grades.php?student_id=<?= $child['student_id'] ?>" class="btn btn-outline-success btn-sm">View</a>
									</td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include '../includes/footer.php'; ?>
