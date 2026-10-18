<?php
$pageTitle = $pageTitle ?? APP_NAME;
$flash = get_flash();
$user = current_user();
$base = $base ?? '';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="CampusConnect student information portal">
  <title><?= e($pageTitle) ?> | <?= e(APP_NAME) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= e($base) ?>assets/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark portal-nav"><div class="container">
  <a class="navbar-brand fw-bold" href="<?= e($base) ?>index.php"><span class="brand-mark">C</span> CampusConnect</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
  <div class="collapse navbar-collapse" id="mainNav"><div class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
  <?php if ($user): ?>
    <span class="navbar-text me-lg-2">Hi, <?= e($user['full_name'] ?? 'Student') ?></span>
    <?php if (($user['role'] ?? '') === 'admin'): ?><a class="nav-link" href="<?= e($base) ?>admin/dashboard.php">Admin dashboard</a><a class="nav-link" href="<?= e($base) ?>admin/students.php">Students</a>
    <?php else: ?><a class="nav-link" href="<?= e($base) ?>student/dashboard.php">My dashboard</a><?php endif; ?>
    <form action="<?= e($base) ?>logout.php" method="post" class="d-inline"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><button class="btn btn-sm btn-light ms-lg-2" type="submit">Sign out</button></form>
  <?php else: ?><a class="nav-link" href="<?= e($base) ?>login.php">Sign in</a><a class="btn btn-sm btn-light ms-lg-2" href="<?= e($base) ?>register.php">Create account</a><?php endif; ?>
  </div></div>
</div></nav>
<main class="container py-4 py-lg-5">
<?php if ($flash): ?><div class="alert alert-<?= e($flash['type']) ?> alert-dismissible fade show" role="alert"><?= e($flash['message']) ?><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div><?php endif; ?>
