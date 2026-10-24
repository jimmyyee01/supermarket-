<?php require __DIR__.'/../layouts/header.php'; ?>
<div class="grid">
<div class="stat"><h4>Today's Sales</h4><p><?php echo number_format($todaySales['t'],2); ?></p><small><?php echo $todaySales['c']; ?> transactions</small></div>
<div class="stat"><h4>Products</h4><p><?php echo $prodCount; ?></p></div>
<div class="stat"><h4>Branches</h4><p><?php echo $branchCount; ?></p></div>
</div>
<div class="card" style="margin-top:20px">
<h3>Quick Actions</h3>
<a class="btn btn-success" href="/supermarket-pos/public/pos">Open POS</a>
<a class="btn" href="/supermarket-pos/public/products/create">Add Product</a>
<a class="btn btn-secondary" href="/supermarket-pos/public/reports">View Reports</a>
</div>
<?php require __DIR__.'/../layouts/footer.php'; ?>
