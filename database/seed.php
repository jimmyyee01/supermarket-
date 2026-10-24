<?php
// database/seed.php - run: php database/seed.php
require __DIR__.'/../config/database.php';
$pdo = db();
$pdo->exec("INSERT IGNORE INTO supermarkets (id,name,currency) VALUES (1,'Demo Supermarket','USD')");
$pdo->exec("INSERT IGNORE INTO branches (id,supermarket_id,name) VALUES (1,1,'Main Branch')");
$hash = password_hash('admin123', PASSWORD_DEFAULT);
$st = $pdo->prepare("INSERT IGNORE INTO users (supermarket_id,branch_id,role_id,username,password_hash,full_name) VALUES (1,1,2,'admin',?,'Admin User')");
$st->execute([$hash]);
echo "Seeded. Login: admin / admin123\n";
