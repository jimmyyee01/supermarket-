<!DOCTYPE html><html><head><meta charset="utf-8"><title>Dashboard</title>
<style>body{font-family:Arial;margin:0;background:#f4f6f9}
.nav{background:#2c7be5;color:#fff;padding:12px 20px;display:flex;justify-content:space-between}
.nav a{color:#fff;margin-left:15px;text-decoration:none}
.cards{display:flex;gap:20px;padding:20px}
.card{background:#fff;padding:20px;border-radius:8px;flex:1;box-shadow:0 2px 6px rgba(0,0,0,.08)}
.card h3{margin:0;color:#555} .card p{font-size:26px;margin:8px 0 0;font-weight:bold}</style></head><body>
<div class="nav"><span>Supermarket POS</span><span>
<a href="/supermarket-pos/public/pos">POS</a>
<a href="/supermarket-pos/public/products">Products</a>
<a href="/supermarket-pos/public/reports">Reports</a>
<a href="/supermarket-pos/public/android" style="color:#fff;margin-left:15px;text-decoration:none">Android POS</a>
<a href="/supermarket-pos/public/auth/logout">Logout</a></span></div>
<div class="cards">
<div class="card"><h3>Today's Sales</h3><p><?php echo number_format($todaySales['t'],2); ?></p><small><?php echo $todaySales['c']; ?> transactions</small></div>
<div class="card"><h3>Products</h3><p><?php echo $prodCount; ?></p></div>
<div class="card"><h3>Branches</h3><p><?php echo $branchCount; ?></p></div>
</div></body></html>
