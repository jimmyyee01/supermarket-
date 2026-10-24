<?php
class PosController {
    public function index() {
        if (empty($_SESSION['user'])) { header('Location: /supermarket-pos/public/auth/login'); exit; }
        $sm = $_SESSION['user']['supermarket_id'];
        $br = $_SESSION['user']['branch_id'] ?? 1;
        $products = db()->prepare("SELECT p.* FROM products p JOIN branch_stock bs ON bs.product_id=p.id WHERE p.supermarket_id=? AND bs.branch_id=? AND bs.quantity>0");
        $products->execute([$sm,$br]);
        $products = $products->fetchAll();
        $pm = db()->prepare('SELECT * FROM payment_methods WHERE supermarket_id=? AND is_enabled=1');
        $pm->execute([$sm]);
        $paymentMethods = $pm->fetchAll();
        require __DIR__.'/../views/pos/index.php';
    }
    public function checkout() {
        if (empty($_SESSION['user'])) { http_response_code(401); exit; }
        $u = $_SESSION['user'];
        $data = json_decode(file_get_contents('php://input'), true);
        $items = $data['items'] ?? [];
        if (!$items) { echo json_encode(['ok'=>false,'msg'=>'empty']); exit; }
        $pdo = db();
        $pdo->beginTransaction();
        try {
            $subtotal = 0;
            foreach ($items as $it) {
                $st = $pdo->prepare('SELECT sell_price,cost_price FROM products WHERE id=?');
                $st->execute([$it['product_id']]);
                $p = $st->fetch();
                $line = $p['sell_price'] * $it['qty'];
                $subtotal += $line;
            }
            $tax = round($subtotal * 0.0, 2);
            $total = $subtotal + $tax;
            $num = 'S'.date('YmdHis');
            $st = $pdo->prepare('INSERT INTO sales (supermarket_id,branch_id,user_id,sale_number,subtotal,tax,total,payment_method) VALUES (?,?,?,?,?,?,?,?)');
            $st->execute([$u['supermarket_id'],$u['branch_id']??1,$u['id'],$num,$subtotal,$tax,$total,$data['payment']??'cash']);
            $saleId = $pdo->lastInsertId();
            foreach ($items as $it) {
                $st = $pdo->prepare('SELECT sell_price,cost_price FROM products WHERE id=?');
                $st->execute([$it['product_id']]);
                $p = $st->fetch();
                $line = $p['sell_price'] * $it['qty'];
                $st = $pdo->prepare('INSERT INTO sale_items (sale_id,product_id,quantity,unit_price,cost_price,total) VALUES (?,?,?,?,?,?)');
                $st->execute([$saleId,$it['product_id'],$it['qty'],$p['sell_price'],$p['cost_price'],$line]);
                $st = $pdo->prepare('UPDATE branch_stock SET quantity=quantity-? WHERE branch_id=? AND product_id=?');
                $st->execute([$it['qty'],$u['branch_id']??1,$it['product_id']]);
            }
            $pdo->commit();
            echo json_encode(['ok'=>true,'sale_id'=>$saleId,'total'=>$total,'number'=>$num]);
        } catch (Exception $e) {
            $pdo->rollBack();
            echo json_encode(['ok'=>false,'msg'=>$e->getMessage()]);
        }
        exit;
    }
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
        if (strtoupper(substr(PHP_OS,0,3))==='WIN') {
            @shell_exec('echo '.chr(27).chr(112).chr(0).chr(25).chr(250).' > "LPT1" 2>nul');
        }
        header('Content-Type: application/json');
        echo json_encode(['ok'=>true]);
        exit;
    }
}
