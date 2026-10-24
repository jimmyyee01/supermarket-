<!DOCTYPE html><html><head><meta charset="utf-8"><title>Reports</title>
<style>body{font-family:Arial;margin:0;background:#f4f6f9}
.nav{background:#2c7be5;color:#fff;padding:12px 20px} .nav a{color:#fff;margin-left:15px;text-decoration:none}
.wrap{padding:20px} table{width:100%;border-collapse:collapse;background:#fff}
th,td{padding:8px;border-bottom:1px solid #eee;text-align:left} th{background:#f0f0f0}
.summary{display:flex;gap:20px;margin-bottom:20px} .s{background:#fff;padding:15px;border-radius:6px;flex:1}</style></head><body>
<div class="nav"><span>Reports</span><a href="/supermarket-pos/public/dashboard" style="color:#fff">Dashboard</a></div>
<div class="wrap">
<form method="get" action="/supermarket-pos/public/reports"><input type="date" name="from" value="<?php echo $from; ?>"> to <input type="date" name="to" value="<?php echo $to; ?>"> <button>Filter</button></form>
<div class="summary">
<div class="s"><b>Total Sales</b><br><?php echo number_format($totalSales,2); ?></div>
<div class="s"><b>Cost of Goods</b><br><?php echo number_format($cost,2); ?></div>
<div class="s"><b>Gross Profit</b><br><?php echo number_format($totalSales-$cost,2); ?></div>
<div class="s"><b>Expenses</b><br><?php echo number_format($exp,2); ?></div>
<div class="s"><b>Net Profit</b><br><?php echo number_format($totalSales-$cost-$exp,2); ?></div>
</div>
<table><tr><th>Date</th><th>Transactions</th><th>Sales</th></tr>
<?php foreach($rows as $r): ?>
<tr><td><?php echo $r['d']; ?></td><td><?php echo $r['c']; ?></td><td><?php echo number_format($r['t'],2); ?></td></tr>
<?php endforeach; ?>
</table></div></body></html>
