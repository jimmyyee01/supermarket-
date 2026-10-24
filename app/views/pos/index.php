<script>
document.getElementById('barcode').addEventListener('keydown', function(e){
  if(e.key==='Enter'){
    const code=this.value.trim(); this.value='';
    fetch('/supermarket-pos/public/pos/barcode?code='+encodeURIComponent(code))
      .then(r=>r.json()).then(p=>{
        if(p && p.id){ add(p.id, p.name, parseFloat(p.sell_price)); }
        else alert('Product not found');
      });
  }
});
</script>

<!DOCTYPE html><html><head><meta charset="utf-8"><title>POS</title>
<style>body{font-family:Arial;margin:0;display:flex;height:100vh}
.left{flex:2;padding:15px;overflow:auto;background:#f4f6f9}
.right{flex:1;padding:15px;background:#fff;border-left:1px solid #ddd;display:flex;flex-direction:column}
.prod{display:inline-block;width:140px;margin:8px;padding:10px;background:#fff;border-radius:6px;box-shadow:0 1px 4px rgba(0,0,0,.1);cursor:pointer;text-align:center}
.cart{flex:1;overflow:auto;border:1px solid #eee;padding:8px}
.row{display:flex;justify-content:space-between;padding:6px 0;border-bottom:1px solid #f0f0f0}
.total{font-size:22px;font-weight:bold;padding:10px 0}
button.pay{padding:12px;background:#28a745;color:#fff;border:none;border-radius:6px;cursor:pointer;font-size:16px}
</style></head><body>
<div class="left">
<input id="barcode" placeholder="Scan barcode / QR" style="width:100%;padding:8px;margin-bottom:8px" autofocus>
<button onclick="fetch('/supermarket-pos/public/pos/openDrawer').then(()=>{})" style="margin-bottom:8px">Open Cash Drawer</button>

<?php foreach($products as $p): ?>
<div class="prod" onclick="add(<?php echo $p['id']; ?>,'<?php echo addslashes($p['name']); ?>',<?php echo $p['sell_price']; ?>)">
<?php echo htmlspecialchars($p['name']); ?><br><b><?php echo number_format($p['sell_price'],2); ?></b>
</div>
<?php endforeach; ?>
</div>
<div class="right">
<h3>Cart</h3>
<div class="cart" id="cart"></div>
<div class="total">Total: <span id="total">0.00</span></div>
<select id="pay"><?php foreach($paymentMethods as $m): ?><option value="<?php echo $m['code']; ?>"><?php echo htmlspecialchars($m['name']); ?></option><?php endforeach; ?></select>
<button class="pay" onclick="checkout()">Checkout</button>
<a href="/supermarket-pos/public/dashboard">Back</a>
</div>
<script>
let cart={};
function add(id,name,price){ if(!cart[id]) cart[id]={name,price,qty:0}; cart[id].qty++; render(); }
function render(){ let html='',tot=0; for(let id in cart){ let c=cart[id]; html+=`<div class="row"><span>${c.name} x${c.qty}</span><span>${(c.price*c.qty).toFixed(2)}</span></div>`; tot+=c.price*c.qty; } document.getElementById('cart').innerHTML=html; document.getElementById('total').textContent=tot.toFixed(2); }
function checkout(){ let items=Object.keys(cart).map(id=>({product_id:id,qty:cart[id].qty})); fetch('/supermarket-pos/public/pos/checkout',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({items,payment:document.getElementById('pay').value})}).then(r=>r.json()).then(d=>{ if(d.ok){ window.open('/supermarket-pos/public/receipt/view/'+d.sale_id,'_blank'); cart={}; render(); } else alert(d.msg); }); }
</script>
</body></html>
