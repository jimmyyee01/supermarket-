<!DOCTYPE html><html><head><meta charset="utf-8"><title>Add Product</title>
<style>body{font-family:Arial;margin:0;background:#f4f6f9}
.nav{background:#2c7be5;color:#fff;padding:12px 20px} .nav a{color:#fff;margin-left:15px;text-decoration:none}
.wrap{padding:20px;max-width:600px;margin:0 auto;background:#fff;border-radius:8px}
input,select,textarea{width:100%;padding:8px;margin:6px 0;border:1px solid #ccc;border-radius:4px;box-sizing:border-box}
button{padding:10px 20px;background:#2c7be5;color:#fff;border:none;border-radius:4px;cursor:pointer}</style></head><body>
<div class="nav"><span>Add Product</span><a href="/supermarket-pos/public/products" style="color:#fff">Products</a></div>
<div class="wrap">
<form method="post" action="/supermarket-pos/public/products/store">
<input name="sku" placeholder="SKU" required>
<input name="barcode" placeholder="Barcode (optional)">
<input name="name" placeholder="Product Name" required>
<select name="category_id"><option value="">-- Category --</option><?php foreach($cats as $c): ?><option value="<?php echo $c['id']; ?>"><?php echo htmlspecialchars($c['name']); ?></option><?php endforeach; ?></select>
<textarea name="description" placeholder="Description"></textarea>
<input name="cost_price" type="number" step="0.01" placeholder="Cost Price" required>
<input name="sell_price" type="number" step="0.01" placeholder="Sell Price" required>
<input name="tax_rate" type="number" step="0.01" placeholder="Tax Rate %">
<input name="unit" placeholder="Unit (pcs/kg/litre)" value="pcs">
<input name="quantity" type="number" step="0.001" placeholder="Initial Stock Qty">
<input name="reorder_level" type="number" step="0.001" placeholder="Reorder Level">
<button type="submit">Save Product</button>
</form></div></body></html>
