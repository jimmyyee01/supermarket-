<?php
class ReportController {
    public function index() {
        if (empty($_SESSION['user'])) { header('Location: /supermarket-pos/public/auth/login'); exit; }
        $u = $_SESSION['user']; $sm = $u['supermarket_id'];
        $from = $_GET['from'] ?? date('Y-m-01');
        $to = $_GET['to'] ?? date('Y-m-d');
        $st = db()->prepare("SELECT DATE(created_at) d, COUNT(*) c, COALESCE(SUM(total),0) t, COALESCE(SUM(subtotal),0) s FROM sales WHERE supermarket_id=? AND DATE(created_at) BETWEEN ? AND ? AND status='completed' GROUP BY DATE(created_at) ORDER BY d");
        $st->execute([$sm,$from,$to]);
        $rows = $st->fetchAll();
        $st = db()->prepare("SELECT COALESCE(SUM(si.quantity*si.cost_price),0) cost FROM sale_items si JOIN sales s ON s.id=si.sale_id WHERE s.supermarket_id=? AND DATE(s.created_at) BETWEEN ? AND ?");
        $st->execute([$sm,$from,$to]);
        $cost = $st->fetch()['cost'];
        $st = db()->prepare("SELECT COALESCE(SUM(amount),0) e FROM expenses WHERE supermarket_id=? AND expense_date BETWEEN ? AND ?");
        $st->execute([$sm,$from,$to]);
        $exp = $st->fetch()['e'];
        $totalSales = array_sum(array_column($rows,'t'));
        require __DIR__.'/../views/reports/index.php';
    }
}
