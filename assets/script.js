(() => {
  'use strict';
  document.querySelectorAll('.needs-validation').forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) { event.preventDefault(); event.stopPropagation(); }
      form.classList.add('was-validated');
    });
  });
  document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', event => {
      if (!window.confirm('Are you sure you want to delete this student record? This action cannot be undone.')) event.preventDefault();
    });
  });
  const confirmPassword = document.querySelector('#confirm_password');
  const password = document.querySelector('#password');
  if (confirmPassword && password) {
    const check = () => confirmPassword.setCustomValidity(confirmPassword.value && confirmPassword.value !== password.value ? 'Passwords do not match.' : '');
    password.addEventListener('input', check); confirmPassword.addEventListener('input', check);
  }
})();
