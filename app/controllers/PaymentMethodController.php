<?php
class PaymentMethodController {
    public function index() {
        if (empty($_SESSION['user'])) { header('Location: /supermarket-pos/public/auth/login'); exit; }
        $u = $_SESSION['user'];
        if ($_SERVER['REQUEST_METHOD']==='POST' && ($_POST['action']??'')==='create') {
            $code = strtolower(preg_replace('/[^a-z0-9_]/','',$_POST['code']));
            $st = db()->prepare('INSERT INTO payment_methods (supermarket_id,code,name,type,gateway,is_enabled) VALUES (?,?,?,?,?,1)');
            $st->execute([$u['supermarket_id'],$code,$_POST['name'],$_POST['type'],$_POST['gateway']?:null]);
            header('Location: /supermarket-pos/public/paymentmethods'); exit;
        }
        if (isset($_GET['toggle'])) {
            $st = db()->prepare('UPDATE payment_methods SET is_enabled=IF(is_enabled=1,0,1) WHERE id=? AND supermarket_id=?');
            $st->execute([(int)$_GET['toggle'],$u['supermarket_id']]);
            header('Location: /supermarket-pos/public/paymentmethods'); exit;
        }
        $st = db()->prepare('SELECT * FROM payment_methods WHERE supermarket_id=? ORDER BY name');
        $st->execute([$u['supermarket_id']]);
        $methods = $st->fetchAll();
        require __DIR__.'/../views/paymentmethods/index.php';
    }
}
