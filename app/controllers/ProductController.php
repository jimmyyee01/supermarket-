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
}
