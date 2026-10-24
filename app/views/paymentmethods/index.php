<!DOCTYPE html><html><head><meta charset="utf-8"><title>Payment Methods</title>
<style>body{font-family:Arial;margin:0;background:#f4f6f9}
.nav{background:#2c7be5;color:#fff;padding:12px 20px} .nav a{color:#fff;margin-left:15px;text-decoration:none}
.wrap{padding:20px} table{width:100%;border-collapse:collapse;background:#fff}
th,td{padding:10px;border-bottom:1px solid #eee} th{background:#f0f0f0}
form.inline{display:inline} input,select{padding:6px;margin:4px;border:1px solid #ccc;border-radius:4px}
button{padding:6px 12px;border:none;border-radius:4px;cursor:pointer;background:#2c7be5;color:#fff}</style></head><body>
<div class="nav"><span>Payment Methods</span><a href="/supermarket-pos/public/dashboard" style="color:#fff">Dashboard</a></div>
<div class="wrap">
<h2>Create Payment Method</h2>
<form method="post">
<input type="hidden" name="action" value="create">
<input name="code" placeholder="Code (e.g. visa)" required>
<input name="name" placeholder="Display Name" required>
<select name="type"><option>cash</option><option>card</option><option>mobile</option><option>gateway</option><option>transfer</option><option>other</option></select>
<input name="gateway" placeholder="Gateway (stripe/flutterwave/...) optional">
<button>Create</button>
</form>
<h2>Existing</h2>
<table><tr><th>Name</th><th>Code</th><th>Type</th><th>Gateway</th><th>Status</th><th>Action</th></tr>
<?php foreach($methods as $m): ?>
<tr><td><?php echo htmlspecialchars($m['name']); ?></td><td><?php echo $m['code']; ?></td><td><?php echo $m['type']; ?></td><td><?php echo $m['gateway']??'-'; ?></td><td><?php echo $m['is_enabled']?'Enabled':'Disabled'; ?></td><td><a href="?toggle=<?php echo $m['id']; ?>"><?php echo $m['is_enabled']?'Disable':'Enable'; ?></a></td></tr>
<?php endforeach; ?>
</table></div></body></html>
