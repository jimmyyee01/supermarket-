<?php
class ReceiptController {
    public function view($id) {
        if (empty($_SESSION['user'])) { header('Location: /supermarket-pos/public/auth/login'); exit; }
        $u = $_SESSION['user'];
        $st = db()->prepare('SELECT s.*, sm.name sm_name, sm.address sm_addr, sm.phone sm_phone, sm.logo_path, sm.currency, b.name branch_name, us.full_name cashier FROM sales s JOIN supermarkets sm ON sm.id=s.supermarket_id JOIN branches b ON b.id=s.branch_id JOIN users us ON us.id=s.user_id WHERE s.id=? AND s.supermarket_id=?');
        $st->execute([(int)$id,$u['supermarket_id']]);
        $sale = $st->fetch();
        if (!$sale) { http_response_code(404); echo 'Not found'; exit; }
        $st = db()->prepare('SELECT si.*, p.name FROM sale_items si JOIN products p ON p.id=si.product_id WHERE si.sale_id=?');
        $st->execute([(int)$id]);
        $items = $st->fetchAll();
        require __DIR__.'/../views/receipt/index.php';
    }
}
