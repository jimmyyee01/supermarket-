<?php
class SuperAdminController {
    public function index() {
        if (empty($_SESSION['user']) || $_SESSION['user']['role_name'] !== 'super_admin') { http_response_code(403); echo 'Forbidden'; exit; }
        $supermarkets = db()->query('SELECT s.*, (SELECT status FROM subscriptions WHERE supermarket_id=s.id ORDER BY id DESC LIMIT 1) sub_status FROM supermarkets s')->fetchAll();
        require __DIR__.'/../views/superadmin/index.php';
    }
    public function subscribe() {
        if (empty($_SESSION['user'])) { http_response_code(401); exit; }
        $sm = (int)($_POST['supermarket_id'] ?? 0);
        $plan = $_POST['plan'] ?? 'basic';
        $amount = (float)($_POST['amount'] ?? 0);
        $gateway = $_POST['gateway'] ?? 'stripe';
        $gw = \PaymentFactory::make($gateway);
        $res = $gw->charge(['amount'=>$amount,'currency'=>'USD','email'=>$_POST['email']??'x@y.com','name'=>'Subscription']);
        $pdo = db();
        $pdo->prepare('INSERT INTO subscriptions (supermarket_id,plan,amount,currency,status,gateway,gateway_ref,started_at,expires_at) VALUES (?,?,?,?,?,?,?,?,?)')
            ->execute([$sm,$plan,$amount,'USD', $res['ok']?'active':'past_due',$gateway,$res['ref']??null,date('Y-m-d'),date('Y-m-d',strtotime('+30 days'))]);
        $subId = $pdo->lastInsertId();
        $pdo->prepare('INSERT INTO subscription_payments (subscription_id,amount,currency,gateway,gateway_ref,status,paid_at) VALUES (?,?,?,?,?,?,?)')
            ->execute([$subId,$amount,'USD',$gateway,$res['ref']??null,$res['ok']?'success':'failed',$res['ok']?date('Y-m-d H:i:s'):null]);
        header('Content-Type: application/json');
        echo json_encode($res);
        exit;
    }
}
