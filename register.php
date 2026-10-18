<?php
require __DIR__.'/config/config.php'; require __DIR__.'/includes/functions.php';
if (current_user()) redirect(current_user()['role']==='admin'?'admin/dashboard.php':'student/dashboard.php');
$errors=[]; $fullName=''; $email=''; $studentNumber='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
 verify_csrf(); $fullName=trim((string)($_POST['full_name']??'')); $email=trim((string)($_POST['email']??'')); $studentNumber=trim((string)($_POST['student_number']??'')); $password=(string)($_POST['password']??''); $confirm=(string)($_POST['confirm_password']??'');
 if (mb_strlen($fullName)<2 || mb_strlen($fullName)>100) $errors[]='Name must be between 2 and 100 characters.';
 if (!valid_email($email)) $errors[]='Enter a valid email address.';
 if (!valid_student_number($studentNumber)) $errors[]='Student number must be 3–30 letters, numbers, or hyphens.';
 if (strlen($password)<8) $errors[]='Password must be at least 8 characters.';
 if ($password!==$confirm) $errors[]='Passwords do not match.';
 if (!$errors) { $check=$pdo->prepare('SELECT id FROM users WHERE email=? OR student_number=?'); $check->execute([$email,$studentNumber]); if ($check->fetch()) $errors[]='That email or student number is already registered.'; }
 if (!$errors) { $stmt=$pdo->prepare("INSERT INTO users (full_name,email,student_number,password_hash,role) VALUES (?,?,?,?, 'student')"); $stmt->execute([$fullName,$email,$studentNumber,password_hash($password,PASSWORD_DEFAULT)]); set_flash('success','Account created. You can now sign in.'); redirect('login.php'); }
}
$pageTitle='Create account'; $base=''; require __DIR__.'/includes/header.php';
?>
<div class="auth-wrap"><section class="auth-card auth-card-wide"><span class="eyebrow">JOIN CAMPUSCONNECT</span><h1 class="h2 fw-bold mt-2">Create your account</h1><p class="text-secondary mb-4">All fields are required. New registrations receive student permissions.</p>
<?php foreach($errors as $error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endforeach; ?>
<form method="post" class="needs-validation" novalidate><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><div class="mb-3"><label for="full_name" class="form-label">Full name</label><input class="form-control" id="full_name" name="full_name" value="<?= e($fullName) ?>" maxlength="100" required><div class="invalid-feedback">Enter your full name.</div></div><div class="row g-3"><div class="col-md-6"><label for="email" class="form-label">Email address</label><input class="form-control" id="email" name="email" type="email" value="<?= e($email) ?>" maxlength="190" required><div class="invalid-feedback">Enter a valid email.</div></div><div class="col-md-6"><label for="student_number" class="form-label">Student number</label><input class="form-control" id="student_number" name="student_number" value="<?= e($studentNumber) ?>" pattern="[A-Za-z0-9-]{3,30}" required><div class="invalid-feedback">Use 3–30 letters, numbers, or hyphens.</div></div></div><div class="row g-3 mt-0"><div class="col-md-6"><label for="password" class="form-label">Password</label><input class="form-control" id="password" name="password" type="password" minlength="8" autocomplete="new-password" required><div class="invalid-feedback">Use at least 8 characters.</div></div><div class="col-md-6"><label for="confirm_password" class="form-label">Confirm password</label><input class="form-control" id="confirm_password" name="confirm_password" type="password" minlength="8" autocomplete="new-password" required><div class="invalid-feedback">Confirm your password.</div></div></div><button class="btn btn-primary btn-lg w-100 mt-4" type="submit">Create account</button></form><p class="text-center text-secondary mt-4 mb-0">Already registered? <a href="login.php">Sign in</a></p></section></div>
<?php require __DIR__.'/includes/footer.php'; ?>
