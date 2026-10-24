<?php
// app/controllers/AuthController.php
class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $u = $_POST['username'] ?? '';
            $p = $_POST['password'] ?? '';
            $st = db()->prepare('SELECT u.*, r.name role_name FROM users u JOIN roles r ON r.id=u.role_id WHERE username=? AND is_active=1');
            $st->execute([$u]);
            $user = $st->fetch();
            if ($user && password_verify($p, $user['password_hash'])) {
                $_SESSION['user'] = $user;
                header('Location: /supermarket-pos/public/dashboard'); exit;
            }
            $err = 'Invalid credentials';
        }
        require __DIR__.'/../views/auth/login.php';
    }
    public function logout() {
        session_destroy();
        header('Location: /supermarket-pos/public/auth/login'); exit;
    }
}
