<?php
require __DIR__.'/config/config.php'; require __DIR__.'/includes/functions.php';
if (current_user()) redirect(current_user()['role']==='admin' ? 'admin/dashboard.php' : 'student/dashboard.php');
$errors=[]; $email='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
 verify_csrf(); $email=trim((string)($_POST['email']??'')); $password=(string)($_POST['password']??'');
 if (!valid_email($email)) $errors[]='Enter a valid email address.';
 if ($password==='') $errors[]='Password is required.';
 if (!$errors) { $stmt=$pdo->prepare('SELECT id,full_name,email,password_hash,role,student_number FROM users WHERE email=? LIMIT 1'); $stmt->execute([$email]); $account=$stmt->fetch();
  if ($account && password_verify($password,$account['password_hash'])) { session_regenerate_id(true); unset($account['password_hash']); $_SESSION['user']=$account; set_flash('success','Welcome back, '.$account['full_name'].'!'); redirect($account['role']==='admin'?'admin/dashboard.php':'student/dashboard.php'); }
  $errors[]='Email or password is incorrect.';
 }
}
$pageTitle='Sign in'; $base=''; require __DIR__.'/includes/header.php';
?>
<div class="auth-wrap"><section class="auth-card"><span class="eyebrow">WELCOME BACK</span><h1 class="h2 fw-bold mt-2">Sign in to your portal</h1><p class="text-secondary mb-4">Use your registered account.</p>
<?php foreach($errors as $error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endforeach; ?>
<form method="post" class="needs-validation" novalidate><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><div class="mb-3"><label for="email" class="form-label">Email address</label><input class="form-control form-control-lg" id="email" name="email" type="email" value="<?= e($email) ?>" autocomplete="email" required><div class="invalid-feedback">Enter a valid email address.</div></div><div class="mb-4"><label for="password" class="form-label">Password</label><input class="form-control form-control-lg" id="password" name="password" type="password" autocomplete="current-password" required><div class="invalid-feedback">Enter your password.</div></div><button class="btn btn-primary btn-lg w-100" type="submit">Sign in</button></form><p class="text-center text-secondary mt-4 mb-0">New here? <a href="register.php">Create an account</a></p></section></div>
<?php require __DIR__.'/includes/footer.php'; ?>
