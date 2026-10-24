<?php
class ServiceController {
    public function index() {
        if (empty($_SESSION['user'])) { header('Location: /supermarket-pos/public/auth/login'); exit; }
        $u = $_SESSION['user'];
        if (($_POST['toggle'] ?? '') !== '') {
            $key = $_POST['key']; $val = (int)$_POST['value'];
            $st = db()->prepare('INSERT INTO services (supermarket_id,`key`,name,is_enabled) VALUES (?,?,?,?) ON DUPLICATE KEY UPDATE is_enabled=?');
            $name = $_POST['name'] ?? $key;
            $st->execute([$u['supermarket_id'],$key,$name,$val,$val]);
            header('Location: /supermarket-pos/public/services'); exit;
        }
        $st = db()->prepare('SELECT * FROM services WHERE supermarket_id=? ORDER BY name');
        $st->execute([$u['supermarket_id']]);
        $services = $st->fetchAll();
        require __DIR__.'/../views/services/index.php';
    }
}
