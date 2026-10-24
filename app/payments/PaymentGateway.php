<?php
// app/payments/PaymentGateway.php
interface PaymentGateway { public function charge(array $data): array; public function verify(string $ref): array; }

class StripeGateway implements PaymentGateway {
    private $sk;
    public function __construct($cfg){ $this->sk=$cfg['secret_key']; }
    public function charge(array $d): array {
        $ch = curl_init('https://api.stripe.com/v1/payment_intents');
        curl_setopt_array($ch,[CURLOPT_RETURNTRANSFER=>true,CURLOPT_POST=>true,CURLOPT_USERPWD=>$this->sk.':',CURLOPT_POSTFIELDS=>http_build_query(['amount'=>(int)round($d['amount']*100),'currency'=>strtolower($d['currency']??'usd'),'payment_method'=>$d['payment_method']??'pm_card_visa','confirm'=>'true'])]);
        $res = json_decode(curl_exec($ch),true); curl_close($ch);
        return ['ok'=>isset($res['status'])&&$res['status']==='succeeded','ref'=>$res['id']??null,'raw'=>$res];
    }
    public function verify(string $ref): array { return ['ok'=>true,'ref'=>$ref]; }
}

class FlutterwaveGateway implements PaymentGateway {
    private $sk;
    public function __construct($cfg){ $this->sk=$cfg['secret_key']; }
    public function charge(array $d): array {
        $ch = curl_init('https://api.flutterwave.com/v3/payments');
        curl_setopt_array($ch,[CURLOPT_RETURNTRANSFER=>true,CURLOPT_POST=>true,CURLOPT_HTTPHEADER=>['Authorization: Bearer '.$this->sk,'Content-Type: application/json'],CURLOPT_POSTFIELDS=>json_encode(['tx_ref'=>'TX'.time(),'amount'=>$d['amount'],'currency'=>$d['currency']??'USD','redirect_url'=>$d['redirect']??'','customer'=>['email'=>$d['email']??'x@y.com','name'=>$d['name']??'Customer']])]);
        $res=json_decode(curl_exec($ch),true); curl_close($ch);
        return ['ok'=>($res['status']??'')==='success','ref'=>$res['data']['id']??null,'link'=>$res['data']['link']??null,'raw'=>$res];
    }
    public function verify(string $ref): array { return ['ok'=>true,'ref'=>$ref]; }
}

class PaystackGateway implements PaymentGateway {
    private $sk;
    public function __construct($cfg){ $this->sk=$cfg['secret_key']; }
    public function charge(array $d): array {
        $ch=curl_init('https://api.paystack.co/transaction/initialize');
        curl_setopt_array($ch,[CURLOPT_RETURNTRANSFER=>true,CURLOPT_POST=>true,CURLOPT_HTTPHEADER=>['Authorization: Bearer '.$this->sk,'Content-Type: application/json'],CURLOPT_POSTFIELDS=>json_encode(['email'=>$d['email']??'x@y.com','amount'=>(int)round($d['amount']*100),'currency'=>$d['currency']??'NGN'])]);
        $res=json_decode(curl_exec($ch),true); curl_close($ch);
        return ['ok'=>($res['status']??false)===true,'ref'=>$res['data']['reference']??null,'link'=>$res['data']['authorization_url']??null,'raw'=>$res];
    }
    public function verify(string $ref): array { return ['ok'=>true,'ref'=>$ref]; }
}

class MtnMomoGateway implements PaymentGateway {
    public function __construct($cfg){ $this->cfg=$cfg; }
    private $cfg;
    public function charge(array $d): array {
        // Request to pay (sandbox). Requires access token first in production.
        return ['ok'=>false,'ref'=>null,'msg'=>'MTN MoMo requires access token flow; implement OAuth first.','raw'=>[]];
    }
    public function verify(string $ref): array { return ['ok'=>true,'ref'=>$ref]; }
}

class AirtelMoneyGateway implements PaymentGateway {
    public function __construct($cfg){ $this->cfg=$cfg; }
    private $cfg;
    public function charge(array $d): array {
        return ['ok'=>false,'ref'=>null,'msg'=>'Airtel Money requires OAuth token flow; implement first.','raw'=>[]];
    }
    public function verify(string $ref): array { return ['ok'=>true,'ref'=>$ref]; }
}

class PaymentFactory {
    public static function make(string $name): PaymentGateway {
        $cfg = require __DIR__.'/../../config/payments.php';
        switch($name){
            case 'stripe': return new StripeGateway($cfg['stripe']);
            case 'flutterwave': return new FlutterwaveGateway($cfg['flutterwave']);
            case 'paystack': return new PaystackGateway($cfg['paystack']);
            case 'mtn_momo': return new MtnMomoGateway($cfg['mtn_momo']);
            case 'airtel_money': return new AirtelMoneyGateway($cfg['airtel_money']);
        }
        throw new Exception('Unknown gateway');
    }
}
