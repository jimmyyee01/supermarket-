<?php require __DIR__.'/../layouts/header.php'; ?>
<a class="btn btn-success" href="/supermarket-pos/public/products/create">+ Add Product</a>
<table style="margin-top:12px">
<tr><th>SKU</th><th>Name</th><th>Category</th><th>Cost</th><th>Sell</th><th>Actions</th></tr>
<?php foreach($products as $p): ?>
<tr>
<td><?php echo htmlspecialchars($p['sku']); ?></td>
<td><?php echo htmlspecialchars($p['name']); ?></td>
<td><?php echo htmlspecialchars($p['cat']??''); ?></td>
<td><?php echo number_format($p['cost_price'],2); ?></td>
<td><?php echo number_format($p['sell_price'],2); ?></td>
<td>
<a class="btn" href="/supermarket-pos/public/products/edit?id=<?php echo $p['id']; ?>">Edit</a>
<a class="btn btn-danger" href="/supermarket-pos/public/products/delete?id=<?php echo $p['id']; ?>" onclick="return confirm('Delete?')">Delete</a>
</td>
</tr>
<?php endforeach; ?>
</table>
<?php require __DIR__.'/../layouts/footer.php'; ?>
