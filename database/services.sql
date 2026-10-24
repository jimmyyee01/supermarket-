CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    supermarket_id INT NOT NULL,
    `key` VARCHAR(60) NOT NULL,
    name VARCHAR(100) NOT NULL,
    is_enabled TINYINT(1) DEFAULT 1,
    config JSON,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (supermarket_id) REFERENCES supermarkets(id) ON DELETE CASCADE,
    UNIQUE KEY uq_svc (supermarket_id, `key`)
);

INSERT IGNORE INTO services (supermarket_id, `key`, name, is_enabled) VALUES
(1,'stripe','Stripe Payments',1),
(1,'flutterwave','Flutterwave Payments',1),
(1,'paystack','Paystack Payments',1),
(1,'mtn_momo','MTN Mobile Money',1),
(1,'airtel_money','Airtel Money',1),
(1,'barcode_scan','Barcode/QR Scanning',1),
(1,'cash_drawer','Cash Drawer',1),
(1,'reports','Financial Reports',1);
