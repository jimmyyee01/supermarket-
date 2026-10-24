<?php
// app/controllers/DashboardController.php
class DashboardController {
    public function index() {
        if (empty($_SESSION['user'])) { header('Location: /supermarket-pos/public/auth/login'); exit; }
        $u = $_SESSION['user'];
        $sm = $u['supermarket_id'];
        $today = date('Y-m-d');
        $st = db()->prepare("SELECT COUNT(*) c, COALESCE(SUM(total),0) t FROM sales WHERE supermarket_id=? AND DATE(created_at)=?");
        $st->execute([$sm,$today]);
        $todaySales = $st->fetch();
        $st = db()->prepare("SELECT COUNT(*) c FROM products WHERE supermarket_id=? AND is_active=1");
        $st->execute([$sm]);
        $prodCount = $st->fetch()['c'];
        $st = db()->prepare("SELECT COUNT(*) c FROM branches WHERE supermarket_id=?");
        $st->execute([$sm]);
        $branchCount = $st->fetch()['c'];
        require __DIR__.'/../views/dashboard/index.php';
    }
}
