<!DOCTYPE html><html><head><meta charset="utf-8"><title>Login - Supermarket POS</title>
<style>body{font-family:Arial;display:flex;justify-content:center;align-items:center;height:100vh;background:#f4f6f9;margin:0}
.box{background:#fff;padding:30px;border-radius:8px;box-shadow:0 2px 10px rgba(0,0,0,.1);width:320px}
input{width:100%;padding:10px;margin:8px 0;border:1px solid #ccc;border-radius:4px;box-sizing:border-box}
button{width:100%;padding:10px;background:#2c7be5;color:#fff;border:none;border-radius:4px;cursor:pointer}
.err{color:red;font-size:13px}</style></head><body>
<div class="box"><h2>Supermarket POS Login</h2>
<?php if(!empty($err)) echo '<p class="err">'.$err.'</p>'; ?>
<form method="post">
<input name="username" placeholder="Username" required>
<input name="password" type="password" placeholder="Password" required>
<button>Login</button></form></div></body></html>
