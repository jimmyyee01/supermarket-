<!DOCTYPE html><html><head><meta charset="utf-8"><title>Receipt</title>
<style>body{font-family:monospace;width:320px;margin:0 auto;padding:10px}
.logo{text-align:center;margin-bottom:8px} .logo img{max-width:120px}
.center{text-align:center} .row{display:flex;justify-content:space-between}
hr{border:none;border-top:1px dashed #000;margin:6px 0}
.items{margin:8px 0} .item{display:flex;justify-content:space-between}
@media print{ .noprint{display:none} }</style></head><body>
<div class="logo"><?php if(!empty($sale['logo_path'])): ?><img src="<?php echo htmlspecialchars($sale['logo_path']); ?>" alt="logo"><?php endif; ?>
<h3><?php echo htmlspecialchars($sale['sm_name']); ?></h3></div>
<div class="center"><?php echo htmlspecialchars($sale['sm_addr']??''); ?><br>Phone: <?php echo htmlspecialchars($sale['sm_phone']??''); ?></div>
<hr>
<div>Receipt: <?php echo $sale['sale_number']; ?></div>
<div>Date: <?php echo $sale['created_at']; ?></div>
<div>Branch: <?php echo htmlspecialchars($sale['branch_name']); ?></div>
<div>Cashier: <?php echo htmlspecialchars($sale['cashier']); ?></div>
<hr>
<div class="items">
<?php foreach($items as $it): ?>
<div class="item"><span><?php echo htmlspecialchars($it['name']); ?> x<?php echo $it['quantity']; ?></span><span><?php echo number_format($it['total'],2); ?></span></div>
<?php endforeach; ?>
</div>
<hr>
<div class="row"><b>Total</b><b><?php echo number_format($sale['total'],2); ?></b></div>
<div>Payment: <?php echo $sale['payment_method']; ?></div>
<hr>
<div class="center">Thank you for shopping!</div>
<div class="noprint" style="text-align:center;margin-top:10px"><button onclick="window.print()">Print</button></div>
</body></html>
