<?php
// app/views/layouts/header.php
$u = $_SESSION['user'] ?? null;
$role = $u['role_name'] ?? '';
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><title>Supermarket POS</title>
<style>
*{box-sizing:border-box} body{font-family:'Segoe UI',Arial,sans-serif;margin:0;background:#f0f2f5;color:#333}
.nav{background:linear-gradient(90deg,#2c7be5,#1a5bb8);color:#fff;padding:12px 24px;display:flex;justify-content:space-between;align-items:center;box-shadow:0 2px 6px rgba(0,0,0,.15)}
.nav .brand{font-weight:700;font-size:18px}
.nav a{color:#fff;margin-left:14px;text-decoration:none;font-size:14px;opacity:.9}
.nav a:hover{opacity:1;text-decoration:underline}
.wrap{max-width:1200px;margin:20px auto;padding:0 20px}
.card{background:#fff;border-radius:10px;padding:20px;box-shadow:0 2px 8px rgba(0,0,0,.06);margin-bottom:20px}
.btn{display:inline-block;padding:8px 16px;background:#2c7be5;color:#fff;border:none;border-radius:6px;cursor:pointer;text-decoration:none;font-size:14px}
.btn-success{background:#28a745} .btn-danger{background:#dc3545} .btn-secondary{background:#6c757d}
table{width:100%;border-collapse:collapse;background:#fff;border-radius:8px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.06)}
th,td{padding:10px 12px;border-bottom:1px solid #eee;text-align:left} th{background:#f8f9fa;font-weight:600}
tr:hover{background:#f9fbfd}
input,select,textarea{width:100%;padding:9px;margin:6px 0;border:1px solid #ddd;border-radius:6px;box-sizing:border-box;font-size:14px}
.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:16px}
.stat{background:#fff;padding:18px;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,.06)}
.stat h4{margin:0;color:#6c757d;font-size:13px;font-weight:500} .stat p{font-size:24px;margin:6px 0 0;font-weight:700;color:#2c7be5}
</style></head><body>
<div class="nav">
<span class="brand">🛒 Supermarket POS</span>
<span>
<a href="/supermarket-pos/public/dashboard">Dashboard</a>
<a href="/supermarket-pos/public/products">Products</a>
<a href="/supermarket-pos/public/pos">POS</a>
<a href="/supermarket-pos/public/reports">Reports</a>
<a href="/supermarket-pos/public/services">Services</a>
<a href="/supermarket-pos/public/paymentmethods">Payments</a>
<a href="/supermarket-pos/public/android">Android</a>
<?php if($role==='super_admin'): ?><a href="/supermarket-pos/public/superadmin">Super Admin</a><?php endif; ?>
<a href="/supermarket-pos/public/auth/logout">Logout</a>
</span>
</div>
<div class="wrap">
