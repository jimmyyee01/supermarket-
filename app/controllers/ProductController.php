<?php
class ProductController {
    public function index() {
        if (empty($_SESSION['user'])) { header('Location: /supermarket-pos/public/auth/login'); exit; }
        $u = $_SESSION['user'];
        $st = db()->prepare('SELECT p.*, c.name cat FROM products p LEFT JOIN categories c ON c.id=p.category_id WHERE p.supermarket_id=? ORDER BY p.name');
        $st->execute([$u['supermarket_id']]);
        $products = $st->fetchAll();
        require __DIR__.'/../views/products/index.php';
    }
    public function create() {
        if (empty($_SESSION['user'])) { header('Location: /supermarket-pos/public/auth/login'); exit; }
        $u = $_SESSION['user'];
        $cats = db()->prepare('SELECT * FROM categories WHERE supermarket_id=?');
        $cats->execute([$u['supermarket_id']]);
        $cats = $cats->fetchAll();
        require __DIR__.'/../views/products/create.php';
    }
    public function store() {
        if (empty($_SESSION['user'])) { header('Location: /supermarket-pos/public/auth/login'); exit; }
        $u = $_SESSION['user'];
        $sm = $u['supermarket_id'];
        $br = $u['branch_id'] ?? null;
        $sku = $_POST['sku']; $name = $_POST['name'];
        $cost = (float)$_POST['cost_price']; $sell = (float)$_POST['sell_price'];
        $tax = (float)($_POST['tax_rate'] ?? 0); $unit = $_POST['unit'] ?? 'pcs';
        $cat = $_POST['category_id'] ?: null; $barcode = $_POST['barcode'] ?: null;
        $desc = $_POST['description'] ?? '';
        $st = db()->prepare('INSERT INTO products (supermarket_id,category_id,sku,barcode,name,description,cost_price,sell_price,tax_rate,unit) VALUES (?,?,?,?,?,?,?,?,?,?)');
        $st->execute([$sm,$cat,$sku,$barcode,$name,$desc,$cost,$sell,$tax,$unit]);
        $pid = db()->lastInsertId();
        if ($br) {
            $qty = (float)($_POST['quantity'] ?? 0);
            $st = db()->prepare('INSERT INTO branch_stock (branch_id,product_id,quantity,reorder_level) VALUES (?,?,?,?) ON DUPLICATE KEY UPDATE quantity=quantity+?');
            $st->execute([$br,$pid,$qty,(float)($_POST['reorder_level'] ?? 0),$qty]);
        }
        header('Location: /supermarket-pos/public/products'); exit;
    }
    public function edit() {
        if (empty($_SESSION['user'])) { header('Location: /supermarket-pos/public/auth/login'); exit; }
        $u = $_SESSION['user'];
        $id = (int)($_GET['id'] ?? 0);
        $st = db()->prepare('SELECT * FROM products WHERE id=? AND supermarket_id=?');
        $st->execute([$id,$u['supermarket_id']]);
        $product = $st->fetch();
        if (!$product) { header('Location: /supermarket-pos/public/products'); exit; }
        $cats = db()->prepare('SELECT * FROM categories WHERE supermarket_id=?');
        $cats->execute([$u['supermarket_id']]);
        $cats = $cats->fetchAll();
        require __DIR__.'/../views/products/edit.php';
    }
    public function update() {
        if (empty($_SESSION['user'])) { header('Location: /supermarket-pos/public/auth/login'); exit; }
        $u = $_SESSION['user'];
        $id = (int)$_POST['id'];
        $sku = $_POST['sku']; $name = $_POST['name'];
        $cost = (float)$_POST['cost_price']; $sell = (float)$_POST['sell_price'];
        $tax = (float)($_POST['tax_rate'] ?? 0); $unit = $_POST['unit'] ?? 'pcs';
        $cat = $_POST['category_id'] ?: null; $barcode = $_POST['barcode'] ?: null;
        $desc = $_POST['description'] ?? '';
        $st = db()->prepare('UPDATE products SET category_id=?,sku=?,barcode=?,name=?,description=?,cost_price=?,sell_price=?,tax_rate=?,unit=? WHERE id=? AND supermarket_id=?');
        $st->execute([$cat,$sku,$barcode,$name,$desc,$cost,$sell,$tax,$unit,$id,$u['supermarket_id']]);
        header('Location: /supermarket-pos/public/products'); exit;
    }
    public function delete() {
        if (empty($_SESSION['user'])) { header('Location: /supermarket-pos/public/auth/login'); exit; }
        $u = $_SESSION['user'];
        $id = (int)($_GET['id'] ?? 0);
        $st = db()->prepare('UPDATE products SET is_active=0 WHERE id=? AND supermarket_id=?');
        $st->execute([$id,$u['supermarket_id']]);
        header('Location: /supermarket-pos/public/products'); exit;
    }
}
