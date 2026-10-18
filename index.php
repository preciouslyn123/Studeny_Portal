<?php
require __DIR__.'/config/config.php'; require __DIR__.'/includes/functions.php';
if (current_user()) redirect(current_user()['role']==='admin' ? 'admin/dashboard.php' : 'student/dashboard.php');
$pageTitle='Welcome'; $base=''; require __DIR__.'/includes/header.php';
?>
<section class="hero rounded-4 p-4 p-lg-5 mb-5"><div class="row align-items-center g-4"><div class="col-lg-7">
<span class="eyebrow">YOUR CAMPUS, ORGANIZED</span><h1 class="display-5 fw-bold mt-3">A simpler way to manage student information.</h1>
<p class="lead text-secondary mt-3">Access student profiles and manage records through one responsive, secure portal.</p><div class="d-flex flex-wrap gap-2 mt-4"><a href="register.php" class="btn btn-primary btn-lg">Get started →</a><a href="login.php" class="btn btn-outline-secondary btn-lg">Sign in</a></div>
</div><div class="col-lg-5"><div class="hero-card"><div class="mini-label">STUDENT SERVICES</div><div class="feature-row"><span class="feature-icon">✓</span><div><strong>Student profiles</strong><small>View your account information</small></div></div><div class="feature-row"><span class="feature-icon">▦</span><div><strong>Centralized records</strong><small>Find student records quickly</small></div></div><div class="feature-row"><span class="feature-icon">⌁</span><div><strong>Secure access</strong><small>Separate student and admin roles</small></div></div></div></div></div></section>
<section class="row g-3"><div class="col-md-4"><div class="info-card h-100"><div class="card-icon">01</div><h2 class="h5 mt-3">Create an account</h2><p class="text-secondary mb-0">Register using your student number and email.</p></div></div><div class="col-md-4"><div class="info-card h-100"><div class="card-icon">02</div><h2 class="h5 mt-3">View your profile</h2><p class="text-secondary mb-0">See the details linked to your account.</p></div></div><div class="col-md-4"><div class="info-card h-100"><div class="card-icon">03</div><h2 class="h5 mt-3">Admin tools</h2><p class="text-secondary mb-0">Authorized admins can create, read, update, search, and delete student records.</p></div></div></section>
<?php require __DIR__.'/includes/footer.php'; ?>
