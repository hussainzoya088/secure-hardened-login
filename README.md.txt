# Secure Modular Login System 🛡️

A PHP-based authentication system built with a focus on **Security Hardening** and **Modular Architecture**.

## 🚀 Key Features
* **SQL Injection Protection:** Uses PDO with prepared statements to prevent malicious database queries.
* **Session Hardening:** Implements `session_regenerate_id()` during login to prevent Session Fixation attacks.
* **XSS Mitigation:** All user-facing data is escaped using `htmlspecialchars()`.
* **Password Security:** Utilizes `password_hash()` with the Argon2/Bcrypt algorithm.
* **Modular Design:** Separation of concerns between core logic (`/app`) and public views (`/public`).

## 📁 Project Structure
* `/app`: Core configuration, security functions, and global headers.
* `/public`: User-accessible pages (Login, Dashboard, Profile).
* `/js`: Client-side validation logic.

## 🛠️ Setup Instructions
1. Clone the repository to your `htdocs` folder.
2. Import the database using the provided SQL dump (if applicable).
3. Rename `app/config.sample.php` to `app/config.php`.
4. Update the database credentials in `app/config.php`.