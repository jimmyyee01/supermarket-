<!DOCTYPE html><html><head><meta charset="utf-8"><title>Super Admin</title>
<style>body{font-family:Arial;margin:0;background:#f4f6f9}
.nav{background:#1a1a2e;color:#fff;padding:12px 20px} .nav a{color:#fff;margin-left:15px;text-decoration:none}
.wrap{padding:20px} table{width:100%;border-collapse:collapse;background:#fff}
th,td{padding:10px;border-bottom:1px solid #eee} th{background:#f0f0f0}</style></head><body>
<div class="nav"><span>Super Admin — Platform Control</span><a href="/supermarket-pos/public/dashboard" style="color:#fff">Dashboard</a></div>
<div class="wrap">
<h2>Supermarkets & Subscriptions</h2>
<table><tr><th>ID</th><th>Name</th><th>Subscription Status</th></tr>
<?php foreach($supermarkets as $s): ?>
<tr><td><?php echo $s['id']; ?></td><td><?php echo htmlspecialchars($s['name']); ?></td><td><?php echo $s['sub_status'] ?? 'none'; ?></td></tr>
<?php endforeach; ?>
</table>
<h3>Create Subscription (via gateway)</h3>
<form method="post" action="/supermarket-pos/public/superadmin/subscribe">
<input name="supermarket_id" placeholder="Supermarket ID" required>
<input name="plan" placeholder="Plan (basic/pro)" required>
<input name="amount" type="number" step="0.01" placeholder="Amount" required>
<input name="email" placeholder="Email">
<select name="gateway"><option>stripe</option><option>flutterwave</option><option>paystack</option><option>mtn_momo</option><option>airtel_money</option></select>
<button>Charge & Activate</button>
</form>
</div></body></html>
