# SchoolLearn — School Learning Platform

SchoolLearn is a PHP and MySQL starter project for a school's online learning platform. It keeps the supplied homepage design and adds working account registration, login, logout, and a protected dashboard.

## Requirements
- XAMPP (Apache and MySQL)
- PHP 8.0 or newer
- MySQL / MariaDB

## Install on XAMPP
1. Copy this project folder into `C:\xampp\htdocs\school_platform\` (or your XAMPP htdocs directory).
2. Open XAMPP Control Panel and start **Apache** and **MySQL**.
3. Open phpMyAdmin at `http://localhost/phpmyadmin`.
4. Import `database/school_platform.sql`.
5. Check the database username and password in `config/database.php`. The defaults are `root` and an empty password.
6. Open `http://localhost/school_platform/`.

## Authentication included
- Student self-registration
- Password hashing with PHP `password_hash()`
- Login verification with `password_verify()`
- PDO prepared statements
- Session ID regeneration on login
- CSRF protection on registration and login
- Protected dashboard and logout

## Roles
New registrations receive the **student** role. Do not allow visitors to choose an admin or teacher role on the public registration form. Assign trusted staff roles manually in phpMyAdmin after verifying their identity.

## Next development stage
The dashboard is currently a starter layout. The next stage is to add administrator user/class/subject management, teacher material uploads and assessment creation, student assignment submissions, and grading/feedback.

## Important deployment note
These defaults are for local XAMPP development only. Before publishing online, use a dedicated database user with a strong password, HTTPS, secure server configuration, and backups.