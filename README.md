# CampusConnect Student Portal

A responsive full-stack student portal built with semantic HTML5, CSS3, Bootstrap 5, vanilla JavaScript, PHP 8+, and MySQL/MariaDB. This project is prepared to match the Web Application Development Course Final Project Specification (2026).

## Features
- Student registration and sign-in/sign-out
- Role-based access control for administrator and student accounts
- Secure password hashing and verification
- PDO database access with prepared statements
- CSRF tokens on POST forms and session ID regeneration after login
- Server-side validation, output escaping, and browser-side validation
- Admin dashboard with student count and recent registrations
- Student CRUD: create, read/list, search, update, delete
- Responsive Bootstrap layout, interactive form validation, password confirmation, and delete confirmation
- SQL schema and demo administrator account

## Requirements
- PHP 8.1+ with PDO MySQL and mbstring extensions
- MySQL 5.7+/8+ or MariaDB
- XAMPP/WAMP/MAMP or PHP-enabled hosting

## Local setup (XAMPP)
1. Copy the `campusconnect_regenerated` folder into `htdocs`.
2. Start Apache and MySQL.
3. Open phpMyAdmin and import `database/schema.sql`.
4. Review `config/config.php`. Defaults are host `localhost`, database `student_portal`, username `root`, and an empty password. Environment variables `DB_HOST`, `DB_NAME`, `DB_USER`, and `DB_PASS` are also supported.
5. Visit `http://localhost/campusconnect_regenerated/`.

## Demo admin credentials
- Email: `admin@campusconnect.test`
- Password: `CampusAdmin2026!`

These credentials are for local grading only. Change or remove the demo account before public deployment. Do not publish real credentials.

## Deployment checklist
1. Create a free PHP/MySQL hosting account (for example, InfinityFree or another platform supported by your instructor).
2. Create a database on the host and import `database/schema.sql`. If the host does not allow `CREATE DATABASE` or `USE`, remove those statements and import the table definition into the database assigned by the host.
3. Update database settings to the hosting provider's values.
4. Upload the project files to the web root and test registration, login, role restrictions, student CRUD, and responsive layouts.
5. Use a live domain/subdomain that includes your own name as required by the instructor, e.g. `firstname-lastname.hosting-domain.example`. Replace this example with the actual domain you obtain.
6. Upload the source to your own GitHub repository. Keep `database/schema.sql` in the repository root under `/database/schema.sql`.
7. Submit both the live URL and GitHub repository URL in the instructor's online form.
8. Change the demo administrator password, enable HTTPS, and never commit production secrets.

## Project structure
```text
campusconnect_regenerated/
├── admin/
│   ├── dashboard.php
│   └── students.php
├── assets/
│   ├── script.js
│   └── style.css
├── config/config.php
├── database/schema.sql
├── includes/
│   ├── footer.php
│   ├── functions.php
│   └── header.php
├── student/dashboard.php
├── index.php
├── login.php
├── logout.php
├── register.php
├── README.md
└── .gitignore
```

## Notes
This is an educational starter and must be tested on your actual local environment and hosting provider. Admin-created student records are assigned a random temporary password, but the application does not yet email credentials or implement password reset; add a secure invitation/reset flow before real-world use. Do not use the demo credentials on a public website.
