<?php require __DIR__.'/../layouts/header.php'; ?>
<div class="card">
<h3>Edit Product</h3>
<form method="post" action="/supermarket-pos/public/products/update">
<input type="hidden" name="id" value="<?php echo $product['id']; ?>">
<input name="sku" value="<?php echo htmlspecialchars($product['sku']); ?>" required>
<input name="barcode" value="<?php echo htmlspecialchars($product['barcode']); ?>" placeholder="Barcode">
<input name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
<select name="category_id"><option value="">-- Category --</option><?php foreach($cats as $c): ?><option value="<?php echo $c['id']; ?>" <?php if($c['id']==$product['category_id']) echo 'selected'; ?>><?php echo htmlspecialchars($c['name']); ?></option><?php endforeach; ?></select>
<textarea name="description"><?php echo htmlspecialchars($product['description']); ?></textarea>
<input name="cost_price" type="number" step="0.01" value="<?php echo $product['cost_price']; ?>" required>
<input name="sell_price" type="number" step="0.01" value="<?php echo $product['sell_price']; ?>" required>
<input name="tax_rate" type="number" step="0.01" value="<?php echo $product['tax_rate']; ?>">
<input name="unit" value="<?php echo htmlspecialchars($product['unit']); ?>">
<button class="btn btn-success" type="submit">Update</button>
<a class="btn btn-secondary" href="/supermarket-pos/public/products">Cancel</a>
</form></div>
<?php require __DIR__.'/../layouts/footer.php'; ?>
