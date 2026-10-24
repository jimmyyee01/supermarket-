<?php
class AndroidController {
    public function index() {
        if (empty($_SESSION['user'])) { header('Location: /supermarket-pos/public/auth/login'); exit; }
        require __DIR__.'/../views/android/index.php';
    }
}
