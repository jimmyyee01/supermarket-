<!DOCTYPE html><html><head><meta charset="utf-8"><title>Services</title>
<style>body{font-family:Arial;margin:0;background:#f4f6f9}
.nav{background:#2c7be5;color:#fff;padding:12px 20px} .nav a{color:#fff;margin-left:15px;text-decoration:none}
.wrap{padding:20px} table{width:100%;border-collapse:collapse;background:#fff}
th,td{padding:10px;border-bottom:1px solid #eee} th{background:#f0f0f0}
button{padding:6px 12px;border:none;border-radius:4px;cursor:pointer}
.on{background:#28a745;color:#fff} .off{background:#dc3545;color:#fff}</style></head><body>
<div class="nav"><span>Services</span><a href="/supermarket-pos/public/dashboard" style="color:#fff">Dashboard</a></div>
<div class="wrap"><table><tr><th>Service</th><th>Status</th><th>Action</th></tr>
<?php foreach($services as $s): ?>
<tr><td><?php echo htmlspecialchars($s['name']); ?></td><td><?php echo $s['is_enabled']?'Enabled':'Disabled'; ?></td><td>
<form method="post" style="display:inline">
<input type="hidden" name="key" value="<?php echo $s['key']; ?>">
<input type="hidden" name="name" value="<?php echo $s['name']; ?>">
<input type="hidden" name="value" value="<?php echo $s['is_enabled']?0:1; ?>">
<button class="<?php echo $s['is_enabled']?'off':'on'; ?>"><?php echo $s['is_enabled']?'Disable':'Enable'; ?></button>
</form></td></tr>
<?php endforeach; ?>
</table></div></body></html>
