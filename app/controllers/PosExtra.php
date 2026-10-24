<?php
// Add to PosController: barcode lookup + open drawer
class PosControllerExtra {
    public function barcode() {
        if (empty($_SESSION['user'])) { http_response_code(401); exit; }
        $code = $_GET['code'] ?? '';
        $u = $_SESSION['user'];
        $st = db()->prepare('SELECT p.* FROM products p JOIN branch_stock bs ON bs.product_id=p.id WHERE (p.barcode=? OR p.sku=?) AND p.supermarket_id=? AND bs.branch_id=?');
        $st->execute([$code,$code,$u['supermarket_id'],$u['branch_id']??1]);
        $p = $st->fetch();
        header('Content-Type: application/json');
        echo json_encode($p ?: ['error'=>'not found']);
        exit;
    }
    public function openDrawer() {
        if (empty($_SESSION['user'])) { http_response_code(401); exit; }
        // Send ESC/POS cash drawer pulse to default printer (Windows). Adjust printer name.
        if (strtoupper(substr(PHP_OS,0,3))==='WIN') {
            // Write to printer via copy command; fallback: shell
            $cmd = 'echo '.chr(27).chr(112).chr(0).chr(25).chr(250).' > "LPT1" 2>nul';
            @shell_exec($cmd);
        }
        header('Content-Type: application/json');
        echo json_encode(['ok'=>true]);
        exit;
    }
}
