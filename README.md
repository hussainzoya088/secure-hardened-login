# Secure Web Application (Hardened PHP)

### 🛡️ Security Features
- **SQLi Protection:** PDO Prepared Statements.
- **Session Security:** `session_regenerate_id()` and HttpOnly cookies.
- **Password Hashing:** Bcrypt (12-character minimum).
- **XSS Mitigation:** `htmlspecialchars()` output escaping.

### 📁 Project Structure
- `/app`: Core logic and modular headers.
- `/public`: Web-accessible entry points (Login/Register/Dashboard).