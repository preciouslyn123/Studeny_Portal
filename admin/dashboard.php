<?php
require __DIR__.'/../config/config.php'; require __DIR__.'/../includes/functions.php'; require_role('admin');
$total=(int)$pdo->query("SELECT COUNT(*) FROM users WHERE role='student'")->fetchColumn();
$recent=$pdo->query("SELECT full_name,email,student_number,created_at FROM users WHERE role='student' ORDER BY created_at DESC LIMIT 5")->fetchAll();
$pageTitle='Admin dashboard'; $base='../'; require __DIR__.'/../includes/header.php';
?>
<div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4"><div><span class="eyebrow">ADMINISTRATION</span><h1 class="h2 fw-bold mt-2 mb-1">Admin dashboard</h1><p class="text-secondary mb-0">Manage student accounts and records.</p></div><a class="btn btn-primary" href="students.php">Manage students</a></div>
<div class="row g-3 mb-4"><div class="col-md-6"><div class="stat-card"><span class="stat-label">REGISTERED STUDENTS</span><div class="stat-value"><?= $total ?></div><small class="text-secondary">Total student accounts</small></div></div><div class="col-md-6"><div class="stat-card"><span class="stat-label">ADMIN ACCOUNT</span><div class="stat-value fs-4">Active</div><small class="text-secondary">Role-protected administrator area</small></div></div></div>
<section class="info-card"><h2 class="h5 fw-bold mb-3">Recently registered students</h2><div class="table-responsive"><table class="table align-middle portal-table"><thead><tr><th>Student</th><th>Student number</th><th>Joined</th></tr></thead><tbody><?php if(!$recent): ?><tr><td colspan="3" class="text-center text-secondary py-4">No student records yet.</td></tr><?php endif; ?><?php foreach($recent as $s): ?><tr><td><strong><?= e($s['full_name']) ?></strong><div class="small text-secondary"><?= e($s['email']) ?></div></td><td><?= e($s['student_number']) ?></td><td><?= e(date('M j, Y',strtotime($s['created_at']))) ?></td></tr><?php endforeach; ?></tbody></table></div></section>
<?php require __DIR__.'/../includes/footer.php'; ?>
