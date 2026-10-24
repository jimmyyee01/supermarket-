<!DOCTYPE html><html><head><meta charset="utf-8"><title>Products</title>
<style>body{font-family:Arial;margin:0;background:#f4f6f9}
.nav{background:#2c7be5;color:#fff;padding:12px 20px} .nav a{color:#fff;margin-left:15px;text-decoration:none}
.wrap{padding:20px} table{width:100%;border-collapse:collapse;background:#fff}
th,td{padding:8px;border-bottom:1px solid #eee} th{background:#f0f0f0}</style></head><body>
<div class="nav"><span>Products</span><a href="/supermarket-pos/public/dashboard" style="color:#fff">Dashboard</a><a href="/supermarket-pos/public/pos" style="color:#fff">POS</a></div>
<div class="wrap"><a href="/supermarket-pos/public/products/create" style="display:inline-block;margin-bottom:10px;padding:8px 14px;background:#28a745;color:#fff;text-decoration:none;border-radius:4px">+ Add Product</a><table><tr><th>SKU</th><th>Name</th><th>Category</th><th>Cost</th><th>Sell</th></tr>
<?php foreach($products as $p): ?>
<tr><td><?php echo htmlspecialchars($p['sku']); ?></td><td><?php echo htmlspecialchars($p['name']); ?></td><td><?php echo htmlspecialchars($p['cat']??''); ?></td><td><?php echo number_format($p['cost_price'],2); ?></td><td><?php echo number_format($p['sell_price'],2); ?></td></tr>
<?php endforeach; ?>
</table></div></body></html>
